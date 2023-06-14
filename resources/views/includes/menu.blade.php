<nav class="side-nav">
    <ul>
       <li>
          <a href="/dash" class="side-menu side-menu--active">
             <div class="side-menu__icon">
                <i data-lucide="home"></i>
             </div>
             <div class="side-menu__title">
                Dashboard
             </div>
          </a>
       </li>
       <li>
         <a href="javascript:;" class="side-menu side-menu">
            <div class="side-menu__icon">
               <i data-lucide="airplay"></i>
            </div>
            <div class="side-menu__title">
               Ações
               <div class="side-menu__sub-icon ">
                  <i data-lucide="chevron-down"></i>
               </div>
            </div>
         </a>
         <ul class="">
            <li>
               <a href="{!! route('proposicoes.seguidas') !!}" class="side-menu">
                  <div class="side-menu__icon">
                     <i data-lucide="git-commit"></i>
                  </div>
                  <div class="side-menu__title">
                   Proposições Seguidas
                  </div>
               </a>
            </li>

            <li>
               <a href="{!! route('proposicoes.all') !!}" class="side-menu">
                  <div class="side-menu__icon">
                     <i data-lucide="git-merge"></i>
                  </div>
                  <div class="side-menu__title">
                    Todas proposições
                  </div>
               </a>
            </li>
         </ul>
      </li>

      <li>
         <a href="{!! route('parlamentar') !!}" class="side-menu side-menu">
            <div class="side-menu__icon">
               <i data-lucide="users"></i>
            </div>
            <div class="side-menu__title">
                    Perfil do parlamentar
            </div>
         </a>
      </li>

      <li>
         <a href="javascript:;" class="side-menu side-menu">
            <div class="side-menu__icon">
               <i data-lucide="clipboard"></i>
            </div>
            <div class="side-menu__title">
           Relatórios
            </div>
         </a>
      </li>


       <li class="side-nav__devider my-6"></li>
       <li>
          <a href="javascript:;" class="side-menu">
             <div class="side-menu__icon">
                <i data-lucide="settings"></i>
             </div>
             <div class="side-menu__title">
                Configurações
                <div class="side-menu__sub-icon ">
                   <i data-lucide="chevron-down"></i>
                </div>
             </div>
          </a>
          <ul class="">
             <li>
                <a href="{!! route('usuarios') !!}" class="side-menu">
                   <div class="side-menu__icon">
                      <i data-lucide="user"></i>
                   </div>
                   <div class="side-menu__title">
                    Usuários
                   </div>
                </a>
             </li>
             <li>
                <a href="{!! route('group') !!}" class="side-menu">
                   <div class="side-menu__icon">
                      <i data-lucide="users"></i>
                   </div>
                   <div class="side-menu__title">
                      Grupos de Usuários
                   </div>
                </a>
             </li>
             <li>
                <a href="{!! route('cache.clear') !!}" class="side-menu">
                   <div class="side-menu__icon">
                      <i data-lucide="refresh-ccw"></i>
                   </div>
                   <div class="side-menu__title">
                    Limpar Cache
                   </div>
                </a>
             </li>
             <li>
                <a href="{!! route('configurador') !!}" class="side-menu">
                   <div class="side-menu__icon">
                    <i data-lucide="settings"></i>
                   </div>
                   <div class="side-menu__title">
                   Configurador
                   </div>
                </a>
             </li>
          </ul>
       </li>

       <li>
         <a href="javascript:;" class="side-menu side-menu">
            <div class="side-menu__icon">
               <i data-lucide="code"></i>
            </div>
            <div class="side-menu__title">
           Logs do sistema
            </div>
         </a>
      </li>
       <li>
        <a href="{!! route('auth.logout') !!}" class="side-menu">
           <div class="side-menu__icon">
              <i data-lucide="log-out"></i>
           </div>
           <div class="side-menu__title">
              Sair
           </div>
        </a>
       </li>
    </ul>

    <center><p class="side-menu__title" style="position: absolute; bottom:40px; left:30px;">Plataforma desenvolvida por <a target="_BLANK" href="https://gaotech.com.br"><img style="max-width:100px" src="{!! asset('imagens/logo-gao.png') !!}"></a></p></center>
 </nav>
 <!-- END: Side Menu -->
