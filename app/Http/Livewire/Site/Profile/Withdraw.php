<?php

namespace App\Http\Livewire\Site\Profile;

use Livewire\Component;
use Livewire\WithPagination;

class Withdraw extends Component
{
    use WithPagination;

    public $all;
    public $deposit = 'all';
    public $user;
    public $cards;
    public $card;

    public $cate = 'income';
    public $isCate = false;

    public $income;
    public $income_desired;
    public $affiliate;
    public $affiliate_desired;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount()
    {
        $this->user = auth()->user();

        // cate
        if ($this->user->isAuthor() && $this->user->isAff()){
            $this->isCate = true;
        }elseif ($this->user->isAff()) {
            $this->cate = 'affiliate';
        }

        // cards
        $cards = $this->user->cards()->get();
        if (count($cards) > 0){
            $this->cards = $cards;
            $this->card = $this->cards->first()->id;
        }



        // meta
        $meta = get_user_meta($this->user->id);
        $this->setData($meta);
    }

    public function setData($meta)
    {
        $this->income = $meta['current_income'];
        $this->income_desired = $meta['current_income'];

        $this->affiliate = $meta['current_affiliate'];
        $this->affiliate_desired = $meta['current_affiliate'];
    }

    public function send()
    {
        if ($this->cate == 'income'){
            $this->validate([
                'income_desired' => 'required_if:cate,==,income|required_if:deposit,==,desired|integer|min:100000|max:' . $this->income,
                'card' => 'required'
            ]);
        }else{
            $this->validate([
                'affiliate_desired' => 'required_if:cate,==,affiliate|required_if:deposit,==,desired|integer|min:100000|max:' . $this->affiliate,
                'card' => 'required'
            ]);
        }


        if ($this->cate == 'income'){
            // income

            if ($this->deposit == 'all'){
                $amount = $this->income;
                $back = 0;
            }else{
                $amount = $this->income_desired;
                $back = $this->income - $this->income_desired;
            }

        }else{
            // affiliate

            if ($this->deposit == 'all'){
                $amount = $this->affiliate;
                $back = 0;
            }else{
                $amount = $this->affiliate_desired;
                $back = $this->affiliate - $this->affiliate_desired;
            }
        }


        $card = $this->cards->find($this->card);
        $this->user->withdraws()->create([
            'amount' => $amount,
            'cate' => $this->cate,
            'bank_card' => [
                'bank_name' => $card->bank_name,
                'card_name' => $card->card_name,
                'card_serial' => $card->card_serial,
                'card_number' => $card->card_number,
                'card_sheba' => $card->card_sheba,
                'card_meli' => $card->card_meli,
            ]
        ]);


        if ($this->cate == 'income'){
            $meta = set_user_meta($this->user->id , ['current_income' => $back]);
        }else {
            $meta = set_user_meta($this->user->id , ['current_affiliate' => $back]);
        }


        $this->setData($meta);
        $this->emit('success-alert');
        $this->emit('refreshComponent');
    }

    public function paginationView()
    {
        return 'vendor.livewire.comment-paginate';
    }

    public function render()
    {
        if ($this->all){
            $lists = $this->user->withdraws()->latest()->paginate(10);
        }else{
            $lists = $this->user->withdraws()->whereStatus('pending')->latest()->paginate(10);
        }
        return view('livewire.site.profile.withdraw' , ['lists' => $lists])->layout('layouts.profile');
    }
}
