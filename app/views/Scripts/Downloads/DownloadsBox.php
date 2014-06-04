<?php
if ($uploads[0]) {
    //USAR DIV'S DE TITULO PADRÃO PARA ESTILIZAÇÃO
    echo '
    <div class="boxDown">
        <div class="TopContents">
            <div class="Feed FeedDate">
                Donwloads
            </div>
        </div>
    ';

        foreach ($uploads as $uploadsRow){
            echo '
            <a href="/media/files/'.$uploadsRow->id_cat_upl.'/'.$uploadsRow->url_upl.'" target="_blank" class="downA">
            <div class="down">
                <div class="downNome">'.$uploadsRow->nome_upl.'</div>
                <div class="downBotao">Baixar</div>
            </div>
            </a>
            ';
        }

    echo '
    </div>
    ';
}
