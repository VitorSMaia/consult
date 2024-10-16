<div>
    <div x-data="{ isModalVisible: @entangle('isModalVisible') }">
        <div x-show="isModalVisible"
             wire:click="updateModalVisible('isModalVisible')"
             class="fixed inset-0 flex items-center justify-center z-20 bg-black bg-opacity-90"></div>
        <div
            x-show="isModalVisible"
            class="fixed right-0 left-0 top-5 flex items-center justify-center z-20">
            <div class="fixed left-50 right-50 top-0 z-20 p-2">
                <button wire:click="updateModalVisible('isModalVisible')">
                    <img class="cursor-pointer w-7 absolute right-0 top-5 z-20" src="{{ asset('./icons/cancel.svg') }}" alt="cancel">
                </button>
                @if($component)
                    @livewire($component, ['params' => $params])
                @endif
            </div>
        </div>
    </div>
</div>
