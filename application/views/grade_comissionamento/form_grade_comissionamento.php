<form id="<?php echo $id_form ?>" onsubmit="return false">

    <input type="hidden" class="form-control" id="ukey" name="ukey">

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="grade">Grade</label>
                <select class="form-control" id="select_grade">
                    <option id="123" name="123" value="123">Selecione</option>
                    <?php foreach ($lista_grade_comissao as $objGrade) : ?>
                        <option id="<?php echo $objGrade['ukey'] ?>" name="<?php echo $objGrade['ukey'] ?>" value="<?php echo $objGrade['ukey'] ?>"><?php echo $objGrade['nome'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="col-md-6">
                <label for="condicao">Condição</label>
                <select class="form-control" id="select_condicao">
                    <option id="123" name="123" value="123">Selecione</option> 
                    <?php foreach ($lista_condicao_comissao as $objCondicao) : ?>
                        <option id="<?php echo $objCondicao['ukey'] ?>" name="<?php echo $objCondicao['ukey'] ?>" value="<?php echo $objCondicao['ukey'] ?>"><?php echo $objCondicao['nome'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="seguradora">Seguradora</label>
                <select class="form-control" id="select_seguradora">
                    <option id="123" name="123" value="123">Selecione</option>
                    <?php foreach ($lista_seguradora as $objseguradora) : ?>
                        <option id="<?php echo $objseguradora['ukey'] ?>" name="<?php echo $objseguradora['ukey'] ?>" value="<?php echo $objseguradora['ukey'] ?>"><?php echo $objseguradora['nome'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="col-md-6">
                <label for="produto">Produto</label>
                <select class="form-control" id="select_produto">
                    <option id="123" name="123" value="123">Selecione</option> 
                    <?php foreach ($lista_produto as $objProduto) : ?>
                        <option id="<?php echo $objProduto['ukey'] ?>" name="<?php echo $objProduto['ukey'] ?>" value="<?php echo $objProduto['ukey'] ?>"><?php echo $objProduto['nome'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="inicio_vigencia">Início vigência</label>
                <input required="" itemid="Inicio vigencia" type="date" class="form-control"  value="" name="inicio_vigencia" id="inicio_vigencia" >
            </div>

            <div class="col-md-6">
                <label for="fim_vigencia">Fim vigência</label>
                <input required="" type="date" class="form-control"  value="" name="fim_vigencia" id="fim_vigencia" maxlength="255" >
            </div>
        </div>
    </div>

    <hr>

    <div class="form-group">
        <div class="row">
            <div class="col-md-2">
                <label for="parcela">Parcela</label>
                <input type="number" class="form-control"  value="" name="parcela" id="parcela" >
            </div>

            <div class="col-md-2">
                <label for="percentual">Percentual</label>
                <input type="number" disabled="" class="form-control"  value="" name="percentual" id="percentual" >
            </div>

            <div class="col-md-4">
                <label for="colaborador">Colaborador</label>
                <select class="form-control" id="select_colaborador">
                    <option id="0000" name="0000" value="0000">Selecione</option>
                    <option id="corretor" name="corretor" value="corretor">Corretor</option>
                    <option id="supervisor" name="supervisor" value="supervisor">Supervisor</option>
                    <option id="gerente" name="gerente" value="gerente">Gerente</option>
                </select>
            </div>

            <div class="col-md-2">
                <label for="vitalicio">Vitalício</label>
                <input type="number" class="form-control"  value="" name="vitalicio" id="vitalicio" >
            </div>

            <div class="col-md-2">
                <label for="percentual_vt">Percentual</label>
                <input disabled="" type="number" class="form-control"  value="" name="percentual_vt" id="percentual_vt" >
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-2">
                <input disabled="" type="button" class="btn btn-success"  value="Adicionar" name="btn_adicionar_grade" id="btn_adicionar_grade" >
            </div>

            <div id="msg_validacao" class="col-md-3">
                <p id="msg" class="label label-danger"></p>
            </div>

        </div>
    </div>

    <div class="form-group">
        <table class="table table-bordered" id="tbl_grade_comissionamento">
            <thead>
                <tr class="info" >
                    <th style="text-align: center">Parcela</th>
                    <th style="text-align: center"><i class="fa fa-percent" aria-hidden="true"></i></th>
                    <th style="text-align: center">Colaborador</th>
                    <th style="text-align: center">Vitalício</th>
                    <th style="text-align: center"><i class="fa fa-percent" aria-hidden="true"></i></th>
                    <th style="text-align: center">Ação</th>
                </tr>
            </thead>
            <tbody id="corpo_tabela_grade">
                
            </tbody>  
        </table>
    </div>

</form>