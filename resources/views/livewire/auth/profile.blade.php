<div>
    <div class="flex flex-col lg:flex-row min-w-[300px] lg:w-[900px] shadow-2xl">
        <div class="bg-gray-900 text-white w-full max-w-[300px] rounded-l-lg">
            <div class="border border-gray-800 shadow-lg rounded-t-xl lg:rounded-tr-none lg:rounded-bl-xl  p-2 flex flex-col justify-center items-center">
                <div class="relative h-32 w-32 sm:mb-0 mb-3 bg-white rounded-lg">
                    <img src="{{ asset('./img/profile.png') }}" alt="image_profile" class=" w-32 h-32 object-cover rounded-2xl">
                </div>
                <div class="flex-auto sm:ml-5 justify-evenly">
                    <div class="flex items-center justify-between sm:mt-2">
                        <div class="flex items-center">
                            <div class="flex flex-col">
                                <div class="w-full flex-none text-lg text-gray-200 font-bold leading-none">{{ $state['full_name'] }}</div>
                                <div class="flex-auto text-gray-400 my-1">
                                    <span class="mr-3 ">{{ $office[$state['office']] ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white text-black min-w-[700px]">
            <form wire:submit.prevent="save"  class="grid grid-cols-1  md:grid-cols-2 lg::grid-cols-3 gap-5 px-5 py-5">
                <x-text-input label="Nome" name="full_name"/>
                <x-select label="Profissão" name="office">
                    <option value="administrator">Administrador de Sistemas</option>
                    <option value="analyst_business">Analista de Negócios</option>
                    <option value="analyst_qa">Analista de QA</option>
                    <option value="analyst_security">Analista de Segurança</option>
                    <option value="architect">Arquiteto</option>
                    <option value="assistant_legal">Assistente Jurídico</option>
                    <option value="business_analyst">Analista de Negócios</option>
                    <option value="civil_engineer">Engenheiro Civil</option>
                    <option value="compliance_officer">Oficial de Compliance</option>
                    <option value="construction_manager">Gerente de Construção</option>
                    <option value="content_creator">Criador de Conteúdo</option>
                    <option value="copywriter">Redator Publicitário</option>
                    <option value="customer_success_manager">Gerente de Sucesso do Cliente</option>
                    <option value="customer_support">Suporte ao Cliente</option>
                    <option value="data_scientist">Cientista de Dados</option>
                    <option value="database_administrator">Administrador de Banco de Dados</option>
                    <option value="designer">Designer</option>
                    <option value="devops_engineer">Engenheiro DevOps</option>
                    <option value="finance_manager">Gerente Financeiro</option>
                    <option value="full_stack_developer">Desenvolvedor Full Stack</option>
                    <option value="graphic_designer">Designer Gráfico</option>
                    <option value="hr_manager">Gerente de RH</option>
                    <option value="insurance_agent">Agente de Seguros</option>
                    <option value="interior_designer">Designer de Interiores</option>
                    <option value="investment_analyst">Analista de Investimentos</option>
                    <option value="it_support">Suporte de TI</option>
                    <option value="legal_assistant">Assistente Jurídico</option>
                    <option value="logistics_coordinator">Coordenador de Logística</option>
                    <option value="marketing_specialist">Especialista em Marketing</option>
                    <option value="mechanical_engineer">Engenheiro Mecânico</option>
                    <option value="mobile_developer">Desenvolvedor Mobile</option>
                    <option value="network_engineer">Engenheiro de Redes</option>
                    <option value="nurse">Enfermeiro</option>
                    <option value="operations_manager">Gerente de Operações</option>
                    <option value="paralegal">Paralegal</option>
                    <option value="pharmacist">Farmacêutico</option>
                    <option value="physician">Médico</option>
                    <option value="product_manager">Gerente de Produto</option>
                    <option value="project_manager">Gerente de Projetos</option>
                    <option value="qa_analyst">Analista de QA</option>
                    <option value="quality_assurance_manager">Gerente de Garantia de Qualidade</option>
                    <option value="real_estate_agent">Corretor de Imóveis</option>
                    <option value="research_scientist">Cientista Pesquisador</option>
                    <option value="sales_manager">Gerente de Vendas</option>
                    <option value="sales_representative">Representante de Vendas</option>
                    <option value="school_principal">Diretor de Escola</option>
                    <option value="security_analyst">Analista de Segurança</option>
                    <option value="social_media_manager">Gerente de Mídias Sociais</option>
                    <option value="supply_chain_manager">Gerente de Cadeia de Suprimentos</option>
                    <option value="teacher">Professor</option>
                    <option value="ux_ui_specialist">Especialista UX/UI</option>
                </x-select>
                <x-text-input label="E-mail" name="email"/>
                <x-text-input-phone label="Telefone" name="phone"/>
                <x-text-input-cpf label="CPF/CNPJ" name="cpf_cnpj"/>

                <button class="col-span-3 cursor-pointer text-white w-max h-10 shadow-lg bg-[#FDC14A] px-2 rounded-lg flex flex-row justify-center items-center" type="submit">Salvar</button>
            </form>
        </div>
    </div>
</div>