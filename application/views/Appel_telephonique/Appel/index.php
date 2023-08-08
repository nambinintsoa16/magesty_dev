<div class="card w-100">
    <div class="card-header">
        <div class="row">
            <div class="form-group col-lg-4">
                <input type="text" class="form-control client form-control-sm" placeholder="Client">

            </div>
            <div class="form-group col-lg-2">
                <button type="submit" id="DetailClient" class="btn btn-success btn-sm"> <i class="fa fa-television"></i>&nbsp; Détail</button>
            </div>

        </div>
        <div class="form-group col-lg-6">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-lg-2">
                        <input type="text" name="minute" class="minute form-control  form-control-sm timer-input" value="00" disabled>
                    </div>
                    <div class="form-group col-lg-2">
                        <input type="text" name="seconde" class="seconde form-control form-control-sm timer-input" value="00" disabled>
                    </div>
                    <div class="form-group col-lg-8">
                        <button type="submit" id="marche" class="btn btn-success btn-sm col-md-5"> <i class="flaticon-whatsapp "></i> Appel</button>
                        <button type="reset" id="fin" class="btn btn-danger btn-sm col-md-5"> <i class="flaticon-power"></i> Fin d'appel</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="details-client form-group col-lg-12 mt-3">
            <div class="row text-center m-2">
                <div class="col-lg-4">
                    <a href="#" id="CFD" class="btn-link">
                        <div class="card card-stats card-success card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-user"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">CLIENT FIDELES</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="#" id="CLOCC" class="btn-link">
                        <div class="card card-stats card-danger card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-users"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">CLIENT OCCASIONNEL</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="#" id="RDV" class="btn-link">
                        <div class="card card-stats card-warning card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-agenda-1"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">RENDEZ-VOUS</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <table class=" w-100 text-center table-bordered table-hover table-striped table-sm listeDesAppel table">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th>Code client</th>
                        <th>Compte facebook</th>
                        <th>Lien facebook</th>
                        <th>Contact</th>
                        <th>Statut</th>
                        <th></th>
                    </tr>
                    <thead>
                    <tbody>

                    </tbody>
            </table>
        </div>
    </div>


    <div class="modal fade" id="modaleFinDAppel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-<?=$nav_color?>">
                    <h5 class="modal-title " id="staticBackdropLabel" >
                      Durée dappel :  <span class="message"></span>
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">STATUT D'APPEL</label>
                                <select name="" id="" class="custom-select form-control form-control-sm">
                                    <option hidden></option>
                                    <option>APPEL ABOUTI</option>
                                    <option>APPEL ECHOUE</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                               <label for="">CODE APPEL</label>
                                <select name="" id="" class="custom-select form-control form-control-sm">
                                    
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">OBSERVATION</label>
                                <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success saveResulAppel" >Enregistré</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>