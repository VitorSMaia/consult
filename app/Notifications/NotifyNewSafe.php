<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyNewSafe extends Notification
{
    use Queueable;

    public $uuid;
    public $client;
    public $type;
    public $form;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($uuid, $client, $form, $type = 'finarte')
    {
        $this->uuid = $uuid;
        $this->client = ucwords(strtolower($client));
        $this->type = $type;
        $this->form = $form;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        $value_requested = number_format($this->form->value_requested ?? 0, 2,',', '.');
        $estimated_safe = number_format($this->form->estimated_safe ?? 0, 2,',', '.');
        $value_tax = number_format($this->form->value_tax ?? 0, 2,',', '.');
        $value_iof = number_format($this->form->value_iof ?? 0, 2,',', '.');
        $value_total = number_format($this->form->value_total ?? 0, 2,',', '.');
        $percentage_iof = number_format($this->form->percentage_iof ?? 0, 2,',', '.');


        if($this->type == 'new_insurance_quote'){
            return (new MailMessage)
                ->subject('Nova cotação de seguro.')
                ->line("Uma nova cotação de seguro, acaba de ser realizada.")
                ->line("ID: $this->uuid")
                ->action('Clique aqui!', url('/safe'));
        }elseif($this->type == 'customer_questions') {
            return (new MailMessage)
                ->subject('Novo cliente com dúvidas')
                ->line("Entre em contato com o possível cliente.")
                ->line("ID: $this->uuid")
                ->action('Clique aqui!', url('/safe'));
        }elseif($this->type == 'close_proposal'){
            return (new MailMessage)
                ->subject('Novo cliente querendo fechar proposta')
                ->line("Entre em contato com o possível cliente.")
                ->line("ID: $this->uuid")
                ->action('Clique aqui!', url('/safe'));
        }elseif($this->form->value_requested == 0){
            return (new MailMessage)
                ->subject('Cotação de Seguro Finarte')
                ->greeting("Olá, $this->client,")
                ->line("Obrigado pelo seu interesse na Finarte! Recebemos os dados da simulação para cotação de seu seguro, e devido ao valor de sua coleção, entraremos em contato em até um dia útil,  para maiores esclarecimentos e poder assim, lhe fornecer um valor mais preciso do seguro para suas obras de arte.")
                ->line("Valor a ser segurado: R$ {$estimated_safe}")
                ->line("Mais uma vez agradecemos pelo contato.");
        }else{
            return (new MailMessage)
                ->subject('Cotação de Seguro Finarte')
                ->greeting("Olá, $this->client,")
                ->line("Obrigado pelo seu interesse na Finarte!")
                ->line("Aqui enviamos os dados recebidos para a cotação do seguro de suas obras de arte, bem como o valor de sua simulação. Em até 1 dia útil, entraremos em contato para lhe fornecer um valor mais preciso para sua coleção.")
                ->line("Dados da simulação de cotação de Seguro de Obras de Arte: ")
                ->line("Valor solicitado para cotação: R$ {$value_requested}")
                ->line("Valor estimado do prêmio: R$ {$value_tax}")
                ->line("Valor do IOF ({$percentage_iof}%): R$ {$value_iof}")
                ->line("Total estimado para o seguro: R$ {$value_total}");
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
