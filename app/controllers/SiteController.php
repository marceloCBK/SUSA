<?php

class SiteController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function Index()
    {
        return View::make('DefaultSite')
            ->with(Config::get('Globals'))
            ->with(
                array(
                    'menu'=>ConteudoController::menu()
                )
            )
            ;
    }

}