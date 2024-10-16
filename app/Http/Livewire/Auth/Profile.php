<?php

namespace App\Http\Livewire\Auth;

use App\Http\Repositories\UserRepository;
use App\Traits\WithToast;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    use WithToast;

    public array $state = [
        'office' => '',
        'company' => '',
//        'colors' => []
    ];

    public $office = [
        'administrator' => 'Administrador de Sistemas',
        'analyst_business' => 'Analista de Negócios',
        'analyst_qa' => 'Analista de QA',
        'analyst_security' => 'Analista de Segurança',
        'architect' => 'Arquiteto',
        'assistant_legal' => 'Assistente Jurídico',
        'business_analyst' => 'Analista de Negócios',
        'civil_engineer' => 'Engenheiro Civil',
        'compliance_officer' => 'Oficial de Compliance',
        'construction_manager' => 'Gerente de Construção',
        'content_creator' => 'Criador de Conteúdo',
        'copywriter' => 'Redator Publicitário',
        'customer_success_manager' => 'Gerente de Sucesso do Cliente',
        'customer_support' => 'Suporte ao Cliente',
        'data_scientist' => 'Cientista de Dados',
        'database_administrator' => 'Administrador de Banco de Dados',
        'designer' => 'Designer',
        'devops_engineer' => 'Engenheiro DevOps',
        'finance_manager' => 'Gerente Financeiro',
        'full_stack_developer' => 'Desenvolvedor Full Stack',
        'graphic_designer' => 'Designer Gráfico',
        'hr_manager' => 'Gerente de RH',
        'insurance_agent' => 'Agente de Seguros',
        'interior_designer' => 'Designer de Interiores',
        'investment_analyst' => 'Analista de Investimentos',
        'it_support' => 'Suporte de TI',
        'legal_assistant' => 'Assistente Jurídico',
        'logistics_coordinator' => 'Coordenador de Logística',
        'marketing_specialist' => 'Especialista em Marketing',
        'mechanical_engineer' => 'Engenheiro Mecânico',
        'mobile_developer' => 'Desenvolvedor Mobile',
        'network_engineer' => 'Engenheiro de Redes',
    ];

//    protected array $rules = [
//        'state.full_name' => 'required|string|max:255',
//        'state.email' => 'required|email|max:255|unique:users,email,' . 'state.id',
//        'state.office' => 'required|string|max:255',
//        'state.cpf_cnpj' => 'required|string|max:255',
//        'state.phone' => 'required|string|max:255',
//    ];
//
//    protected array $messages = [
//        'state.full_name.required' => 'O nome é obrigatório.',
//        'state.email.required' => 'O e-mail é obrigatório.',
//        'state.email.email' => 'O e-mail deve ser válido.',
//        'state.email.unique' => 'O e-mail já está em uso.',
//        'state.cpf_cnpj.required' => 'O cpf/cnpj é obrigatório.',
//    ];

    /**
     * @return void
     */
    public function mount(): void
    {
        $user = Auth::user();
        $this->state = $user->toArray();
    }

    /**
     * @param UserRepository $userRepository
     * @return void
     */
    public function save(bool $editUser = true): void
    {
        $request = $this->state;

        $userRepository = new UserRepository();
        $userRepositoryReturn = $userRepository->profileUpdate($request);

        if($editUser) {
            $this->openToast($userRepositoryReturn['message'], $userRepositoryReturn['code']);
        }
    }

    /**
     * @return void
     */
    public function updatedStateColor(): void
    {
        $this->save(false);
        session()->forget('color');
        session()->push('color', $this->state['color']);
        redirect()->intended(route('profile'));
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.auth.profile');
    }
}
