<?php

class ErDijagramController extends AutorizacijaController
{
    public function index()
    {
        $this->view->render('privatno' . DIRECTORY_SEPARATOR .
                            'erdijagram');
    }
}