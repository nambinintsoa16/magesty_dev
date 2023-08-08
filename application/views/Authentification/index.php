<?php
$matricule_incorect = ($this->session->flashdata("erreur_matricule") === NULL ? "" : $this->session->flashdata("erreur_matricule"));
$password_incorect = ($this->session->flashdata("erreur_password") === NULL ? "" : $this->session->flashdata("erreur_password"));
$class_erreur_matricule = (!empty($matricule_incorect) ? "erreur" : "");
$class_erreur_password = (!empty($password_incorect) ? "erreur" : "");
?>
<div class="form-box card" id="login-box">
    <form action="<?= base_url("authentification") ?>" method="post">
        <div class="body bg-gray">
            <div class="form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="motDePasse">
                        <i class="fa fa-user"></i>
                    </span>

                    <input type="text" name="matricule" onKeyUp="javasrcipt:this.value=this.value.toUpperCase();" class="matricule form-control <?= $class_erreur_matricule ?>" value="<?= (empty($matricule_incorect) ? set_value("User ID") : "") ?>" name="User_ID" placeholder="<?= (empty($matricule_incorect) ? "Matricule" : $matricule_incorect) ?>" required autofocus />
                </div>
            </div>


            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="motDePasse">
                        <i class="fa fa-lock"></i>
                    </span>
                </div>
                <input type="password" class="form-control <?= $class_erreur_password ?> password" name="password" placeholder="<?= (empty($password_incorect) ? "Password" : $password_incorect) ?>" aria-describedby="motDePasse" required />
                <div class="input-group-prepend">
                    <span class="input-group-text" id="motDePasse">
                        <a href="#" class="control-input-pass"><i class="fa fa-eye-slash"></i></a>
                    </span>
                </div>
            </div>
            <button type="submit" class="btn bg-primary btn-block text-white login">Connexion</button>
        </div>
    </form>
</div>