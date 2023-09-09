<?php

namespace App\Controller;

use App\Entity\Car;
use App\HelperTrait;
use App\PaginationClass;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class CarController extends AbstractController
{
    use HelperTrait;

    public function __construct(private EntityManagerInterface $em)
    {

    }

    /*
     * Post ( brandName , name , gasEconomyRate )  not Required
     * Post sortBy values in: [ name , brand , gasEconomyRate ]  not Required
     * */
    #[Route('/car', name: 'app_car' , methods: ['post'])]
    public function index(Request $request): JsonResponse
    {
        // --- for pagination ---
        $limit = 2;
        $pagination = new PaginationClass($limit);
        $page_number = $pagination->get_page_number()  ;
        $offset = $pagination->get_offset();

        // --- Post data (filters) ---
        $filter_brandName = $request->get('brandName');
        $filter_name = $request->get('name');
        $filter_gasEconomyRate = $request->get('gasEconomyRate');
        $filter_sortBy = $request->get('sortBy');

        /* --------- adding selected filters to filterArray ------------- */
        $filterArray = [
            ['name'=>'car.name','val'=> $filter_name],
            ['name'=>'brand.name','val'=> $filter_brandName],
            ['name'=>'car.gasEconomyRate','val'=> $filter_gasEconomyRate]
        ];

        // --- determine filter column  ---
        $sortBy_col = match ($filter_sortBy){
            'name' => 'car.name',
            'brand' => 'brand.name',
            'gasEconomyRate' => 'car.gasEconomyRate',
            default => 'car.id'
        };

        $CarRepo = $this->em->getRepository(Car::class);

        $cars = $CarRepo->getFilteredList_paginate(
            filterArray: $filterArray ,
            limit: $limit,
            offset: $offset,
            sortBy: $sortBy_col
        );

        $count_total = $CarRepo->getFiltered_count($filterArray);
        $pagination->set_total($count_total);

        return new JsonResponse([
            'success' => true,
            'data'    =>  $cars,
            'total' => $pagination->get_total(),
            'next_page_url' =>  $pagination->get_next_page_url($request),
        ]);
    }
}
