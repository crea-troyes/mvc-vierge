<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;

class HomeController extends Controller
{
    public function index(): void
    {
        $title = "Accueil - Créa-code";
        View::render('home/index', compact('title'));
    }
}