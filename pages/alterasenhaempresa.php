<form id="form_altera_senha" method="POST" class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="TituloEsqueciSenha">Esqueci minha senha</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body col-md-12 offset-md-12 flex column align-items-center">
            <div class="form_align">
                <label for="E-mail">E-mail ou CNPJ:</label>
                <input type="text" class="cor input_altera_senha" id="email" name="email">
            </div>
            <div class="form_align">
                <label for="senha">Nova senha:</label>
                <input type="password" class="cor input_altera_senha" id="novasenha" name="senha">
            </div>
            <div class="form_align">
                <label for="senha">Confirme a nova senha:</label>
                <input type="password" class="cor input_altera_senha" id="confirmasenha" name="senha">
            </div>
            <?php
            if (isset($_SESSION) && isset($_SESSION['mensagem'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_SESSION['mensagem']; ?>
                </div>
            <?php unset($_SESSION['mensagem']);
            }
            ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-warning" onclick="save();">Salvar</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Fechar</button>
        </div>
    </div>
</form>


<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    function save() {
        var inp = document.getElementsByClassName('input_altera_senha');
        var form_Data = new FormData();
        var novasenha = document.getElementById('novasenha');
        var confirmasenha = document.getElementById('confirmasenha');

        if (novasenha.value != confirmasenha.value) {
            toastr.error('As senhas inseridas não são iguais.');
            return;
        }

        for (let i = 0; i < inp.length; i++) {
            form_Data.append(inp[i].name, inp[i].value);
        }

        fetch('../source/controller/alterarsenha.controller.php?tipo=empresa', {
                method: 'post',
                body: form_Data
            }).then(res => res.json())
            .then(res => {
                console.log(res);
                if (res.sucesso == true) {
                    toastr.success(res.mensagem);
                } else {
                    toastr.error(res.mensagem);
                }
            })
            .catch(err => console.error('erro :: ', err))
    }


    document.getElementById('form_altera_senha')
        .addEventListener('submit', ($event) => {
            $event.preventDefault();
        })
</script>