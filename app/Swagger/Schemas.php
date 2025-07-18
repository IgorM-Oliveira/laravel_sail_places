<?php

namespace App\Swagger;

/**
 * @OA\Schema(
 *     schema="Place",
 *     type="object",
 *     title="Place",
 *     required={"id", "name", "city", "type"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Praia do Sol"),
 *     @OA\Property(property="city", type="string", example="Rio de Janeiro"),
 *     @OA\Property(property="type", type="string", example="Praia"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 *
 * @OA\Schema(
 *     schema="PlaceRequest",
 *     type="object",
 *     title="PlaceRequest",
 *     required={"name", "city", "type"},
 *     @OA\Property(property="name", type="string", example="Praia do Sol"),
 *     @OA\Property(property="city", type="string", example="Rio de Janeiro"),
 *     @OA\Property(property="type", type="string", example="Praia")
 * )
 */
class Schemas {}
