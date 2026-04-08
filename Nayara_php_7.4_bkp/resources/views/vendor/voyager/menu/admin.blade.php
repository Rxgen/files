<ol class="dd-list">
@php 
//dd($items);
foreach($items as $key => $value){
    foreach($value->children as $key1 => $value1){
        $main_key = (int)$value1->order-1;
        $value->children[$main_key] = $value1;
        foreach($value1->children as $key2 => $value2){
            $main_key1 = (int)$value2->order-1;
            $value1->children[$main_key1] = $value2;
            foreach($value2->children as $key3 => $value3){
                $main_key2 = (int)$value3->order-1;
                $value2->children[$main_key2] = $value3;
            }
        }
    }
}
//dd($items); 
@endphp
@foreach ($items as $item)

    <li class="dd-item" data-id="{{ $item->id }}">
        <div class="pull-right item_actions">
            <div class="btn btn-sm btn-danger pull-right delete" data-id="{{ $item->id }}" data-order="{{ $item->order}}" >
                <i class="voyager-trash"></i> {{ __('voyager::generic.delete') }}
            </div>
            <div class="btn btn-sm btn-primary pull-right edit"
                data-id="{{ $item->id }}"
                data-title="{{ $item->title }}"
                data-url="{{ $item->url }}"
                data-target="{{ $item->target }}"
                data-icon_class="{{ $item->icon_class }}"
                data-color="{{ $item->color }}"
                data-route="{{ $item->route }}"
                data-parameters="{{ json_encode($item->parameters) }}"
            >
                <i class="voyager-edit"></i> {{ __('voyager::generic.edit') }}
            </div>
        </div>
        <div class="dd-handle">
            @if($options->isModelTranslatable)
                @include('voyager::multilingual.input-hidden', [
                    'isModelTranslatable' => true,
                    '_field_name'         => 'title'.$item->id,
                    '_field_trans'        => json_encode($item->getTranslationsOf('title'))
                ])
            @endif
            <span>{{ $item->title }}</span> <small class="url">{{ $item->link() }}</small>
        </div>
        @if(!$item->children->isEmpty())
            @include('voyager::menu.admin', ['items' => $item->children])
        @endif
    </li>

@endforeach

</ol>
