<?php

class SiteController extends \BaseController {


    public function menu()
    {
        $menu = Cursos
            ::where('status_cur', 1)
            ->orderBy('nome_cur', 'asc')
            ->get();

        return $menu;
    }

    public function Index()
    {
        return View::make('SiteDefault')
            ->with(Config::get('Globals'))
            ->with(
                array(
                    'menu'=>SiteController::menu()
                )
            )
            ;
    }

    public function mostrarArquivos($id)
    {
        /*
        //TODO Descobrir como usar o select abaixo
        select * FROM (
            select * from `arquivos_arq`
            left join `conteudos_con` on `id_fk_arq` = `id_con`
            left join `cursos_cur` on `id_cur_con` = `id_cur`
            where `id_cur_con` = 3
            order by id_arq DESC
        ) as arquivos
        group by id_con

        $arquivos = DB::table(
            '('.Arquivos
                ::leftJoin('conteudos_con', 'id_fk_arq', '=', 'id_con')
                ->leftJoin('cursos_cur', 'id_cur_con', '=', 'id_cur')
                ->where('id_cur', $id)
                ->orderBy('id_arq', 'desc')
                ->toSql().')'
        )->groupBy('id_con')->get();*/
        $cursos = Cursos::find($id);
        $arquivos = Arquivos
            ::leftJoin('conteudos_con', 'id_fk_arq', '=', 'id_con')
            ->leftJoin('cursos_cur', 'id_cur_con', '=', 'id_cur')
            ->where('id_cur', $id)
            ->where('status_site_con', 1)
            ->orderBy('id_arq', 'desc')
            ->groupBy('id_con')
            ->get();

        //return var_dump($arquivos[1]);

        return View::make('SiteListArquivos')
            ->with(Config::get('Globals'))
            ->with([
                'menu'      => SiteController::menu(),
                'conteudos' => $arquivos,
                'cursos'    => $cursos,
            ]);
    }

}