<?php

namespace App\Http\Livewire\Site\Profile;

use App\Models\Product;
use Livewire\Component;

class DiscussionItem extends Component
{
    public $item;
    public $dropReply;
    public $bodyReply;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function sendReply()
    {
        $data = $this->validate([
            'bodyReply' => 'required|min:10',
        ]);

        $user = auth()->user();

        $this->item->replies()->create([
            'user_id' => $user->id,
            'body' => $data['bodyReply'],
            'status' => true,
            'meta' => ['product_id' => $this->item->meta['product_id']]
        ]);
        Product::whereId($this->item->meta['product_id'])->increment('discussion');


        $this->bodyReply = '';
        $this->dropReply = false;
        $this->emit('success-alert');
        $this->emit('refreshComponent');
    }

    public function render()
    {
        return <<<'blade'
            <div x-data="{reply: @entangle('dropReply').defer}" class="bg-white border dark:bg-gray-700 rounded-lg duration-500 mt-3 p-5">
                <div class="flex items-center">
            <img class="rounded-full ml-5" width="50px" src="{{ img_url($item->user->avatar) }}" alt="{{ $item->user->get_display_name() }}">
            <div class="w-full">
                <div class="flex items-center justify-between mb-2">
                    <span>{{ $item->user->get_display_name() }}</span>
                    <div class="flex items-center gap-5">
                        <span class="text-gray-500 text-sm hidden lg:block">{{ d_date($item->created_at) }}</span>
                        <button @click="reply = !reply" class="btn btn-gray">ارسال پاسخ</button>
                    </div>
                </div>
                <a target="_blank" class="text-gray-500 text-sm" href="{{ $item->discussable->path() }}">
                    <i class="fal fa-link ml-2 text-md"></i>
                    {{ $item->discussable->fa_title }}
                </a>
            </div>
        </div>
                <div class="bg-gray-100 rounded-md p-3 text-gray-600 text-sm leading-loose mt-8">
            {!! nl2br($item->body) !!}
        </div>

                <div x-show.transition="reply"
             class="bg-white dark:bg-gray-600 border-2 border-gray-100 dark:border-gray-500 transition duration-500 rounded-xl my-5 p-4">
            <form method="POST" wire:submit.prevent="sendReply">
                @csrf
                <textarea rows="5" wire:model.defer="bodyReply"
                          class="w-full rounded-md focus:ring-0 border-gray-200 focus:border-gray-300 transition text-sm leading-loose text-gray-500"
                          placeholder="پاسخ خود را بنویسید ..."></textarea>

                <x-auth.auth-validation-error name="bodyReply"/>

                <div class="flex items-center justify-end gap-4">
                    <div>
                        <span wire:loading wire:target="sendReply" class="text-xs text-green-500">در حال ثبت...</span>
                        <button wire:loading.remove wire:target="sendReply" type="submit" class="cursor-pointer btn btn-green">ثبت پاسخ</button>
                    </div>
                </div>
            </form>
        </div>

                 @if(count($item->replies) > 0)
                      @foreach($item->replies as $reply)
                        <livewire:site.profile.discussion-item :item="$reply" wire:key="{{ $reply->id }}"/>
                      @endforeach
                 @endif
            </div>

        blade;

    }
}
