<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Console\Command;

class ConvertToWebp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'convert:to-webp {--img=* : image to convert} {--dir=* : directory to convert images from}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert existing images to WEBP images';

    private $allowedExtensions, $allowedDirectories, $storageDisk;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        ini_set('max_execution_time', -1); // 900 (seconds) = 15 Minutes
        $this->storageDisk = Storage::disk(config('voyager.storage.disk'));
        $this->allowedExtensions = $this->allowedExtensions();
        $this->allowedDirectories = $this->allowedDirectories();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->comment('Please wait this may take some time.');
        $this->comment('Images with these extensions only will be converted to WEBP: '. implode(', ', $this->allowedExtensions));

        $inputImages = $this->option('img');

        if ( !empty($inputImages) ) {
            $this->processImages($inputImages);
            return;
        }

        $inputDirectories = $this->option('dir');
        // if input DIRs are not present in $this->allowedDirectories then show error message
        if (count(array_diff($inputDirectories, $this->allowedDirectories))) {
            $this->error('Given input DIRs are not valid');
            $this->comment('Please provide any of these DIRs = '. implode(', ', $this->allowedDirectories));
            $this->error('TRY AGAIN.');
            return;
        }

        $directories = !empty($inputDirectories) ? $inputDirectories : $this->allowedDirectories;
        $directories = array_unique($directories);

        $this->processDirectories($directories);
    }

    private function allowedExtensions()
    {
        return [
            'jpg',
            'jpeg',
            'png',
        ];
    }

    private function allowedDirectories()
    {
        return $this->storageDisk->directories();
    }

    private function processImages($images)
    {
        try {
            foreach ($images as $image) {
                if (!$this->storageDisk->exists($image)) {
                    $this->error($image.' = does NOT exists');
                    continue;
                } elseif (!$this->validateImage($image)) {
                    $this->error($image.' = INVALID image extension');
                    continue;
                }
                $this->createWebpImage($image, getWebpVersion($image));
                $this->info($image.' = converted to WEBP');
            }
        } catch (\Throwable $e) {
            $this->error($e->getMessage());
            report($e);
        }
    }

    private function processDirectories($directories)
    {
        try {
            foreach ($directories as $dir) {
                $this->info('Converting Images from "'. $dir. '" directory');
                $files = $this->storageDisk->allFiles($dir);
                $bar = $this->output->createProgressBar(count($files));
                $bar->setFormat('debug');
                $files = array_chunk($files, 1000);
                foreach ($files as $fileChunk) {
                    foreach ($fileChunk as $file) {
                        if ($this->validateImage($file)) {
                            $this->saveWebpImage($file);
                        }
                        $bar->advance();
                    }
                }
                $bar->finish();
                $this->line('');
            }
        } catch (\Throwable $e) {
            $this->error($e->getMessage());
            report($e);
        }
    }

    private function validateImage($imgPath)
    {
        $imgUrlArr = explode('.', $imgPath);
        $imgExtension = strtolower(end($imgUrlArr));

        return in_array($imgExtension, $this->allowedExtensions);
    }

    private function createWebpImage($filePath, $webpImgPath)
    {
        try {
            $originalFile = $this->getOriginalImageFile($this->storageDisk->url($filePath));
            $webpImg = (string) Image::make($originalFile)->encode('webp');
            $this->storageDisk->put($webpImgPath, $webpImg, 'public');
        } catch (\Throwable $e) {
            $this->error($e->getMessage());
            report($e);
        }
    }

    public function saveWebpImage($data, $images = null)
    {
        try {
            if (empty($data)) {
                return;
            }

            $paths = explode('/', $data);

            if (isset($paths[2]) && !empty($paths[2])) {
                $imgName = substr($paths[2], 0, strpos($paths[2], '.'));
            } else {
                return;
            }

            $webpImgPath = $paths[0].'/'.$paths[1].'/'.$imgName.'.webp';

            if ($this->storageDisk->exists($webpImgPath)) {
                return true;
            }

            $originalFile = $this->getOriginalImageFile($this->storageDisk->url($data));
            $webpImg = (string) Image::make($originalFile)->encode('webp');
            $this->storageDisk->put($webpImgPath, $webpImg, 'public');

            return $webpImgPath;
        } catch (\Throwable $e) {
            $this->error($e->getMessage());
            report($e);
        }
    }

    private function getOriginalImageFile($fileUrl)
    {
        if (in_array(app('env'), ['local', 'dev','prod'])) {
            // avoid SSL operation failed error for local and dev env
            $contextOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false
                ]
            ];

            return file_get_contents($fileUrl, false, stream_context_create($contextOptions));
        }

        return file_get_contents($fileUrl);
    }
}
