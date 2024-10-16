<div class="overflow-x-auto mt-5 rounded-t-2xl">
    <table>
        <thead>
        <tr>
            @foreach($columns as $column)
                <th scope="col">{{ $column['label'] }}</th>
            @endforeach
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    @foreach($columns as $column)
                        <td>{{ data_get($item, $column['column']) }}</td>
                    @endforeach
                    <td class="flex justify-start items-center gap-x-2">
                    @if($action)
                        @foreach($action as $itemAction)
                            <x-button wire:click="openModal('{{ $itemAction['column'] }}', {id: {{ $item['id'] }}, title: '{{ $itemAction['title'] }}'})" class="{{  $itemAction['color'] }}" icon=" {{  $itemAction['icon'] }}" label="{{ $itemAction['label'] }}"/>
                        @endforeach
                    @endif
                    @if($delete)
                        <x-button wire:confirm="Are you sure you want to delete this item?" wire:click="destroy({{ $item }})" class="bg-danger" icon="delete" label="Deletar"/>
                    @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>