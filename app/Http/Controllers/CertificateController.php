<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductsServiceInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CertificateController extends Controller
{
    public function __construct(
        protected ProductsServiceInterface $productsService
    ) {}
    public function showProductCertificates(): View
    {
        $data = $this->productsService->getProducts('certificate');
        return view('Catalog/Certificates/certificates', compact('data'));
    }
}
