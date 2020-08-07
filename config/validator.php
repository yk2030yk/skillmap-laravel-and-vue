<?php

return [
    'api' => [
        'skillmap' => [
            'skill' => [],
            'certification' => [],
        ],
        'annual' => [
            'search' => [],
        ],
        'member' => [
            'search' => [],
            'create' => [
                'id'      => 'required|member_id',
                'name'    => 'required|max:30',
                'team_id' => 'required|exists:teams,id'
            ],
            'update' => [
                'id'   => 'required|numeric|exists:skill_large_categories,id',
                'name' => 'required|max:30',
            ],
            'delete' => [
                'id' => 'required|numeric|exists:skill_large_categories,id',
            ],
        ],
        'skillLargeCategory' => [
            'search' => [],
            'create' => [
                'name' => 'required|max:100',
            ],
            'update' => [
                'id'   => 'required|numeric|exists:skill_large_categories,id',
                'name' => 'required|max:100',
            ],
            'delete' => [
                'id' => 'required|numeric|exists:skill_large_categories,id',
            ],
        ],
        'skillSmallCategory' => [
            'search' => [],
            'create' => [
                'name'                    => 'required|max:100',
                'skill_large_category_id' => 'required|exists:skill_large_categories,id',
            ],
            'update' => [
                'id'                       => 'required|numeric|exists:skill_small_categories,id',
                'name'                     => 'required_without_all:skill_large_category_id|max:100',
                'skill_large_category_id'  => 'numeric|exists:skill_large_categories,id',
            ],
            'delete' => [
                'id' => 'required|numeric|exists:skill_small_categories,id',
            ],
        ],
        'skill' => [
            'search' => [],
            'create' => [
                'name'                    => 'required|max:100',
                'skill_small_category_id' => 'required|exists:skill_small_categories,id',
            ],
            'update' => [
                'id'                      => 'required|numeric|exists:skills,id',
                'name'                    => 'required_without_all:skill_large_category_id,skill_small_category_id|max:100',
                'skill_small_category_id' => 'numeric|exists:skill_small_categories,id',
            ],
            'delete' => [
                'id' => 'required|numeric|exists:skills,id',
            ],
        ],
        'certificationCategory' => [
            'search' => [],
            'create' => [
                'name' => 'required|max:100',
            ],
            'update' => [
                'id'   => 'required|numeric|exists:certification_categories,id|max:100',
                'name' => 'required',
            ],
            'delete' => [
                'id' => 'required|numeric|exists:certification_categories,id',
            ],
        ],
        'certification' => [
            'search' => [],
            'create' => [
                'name'                      => 'required|max:100',
                'certification_category_id' => 'required|exists:certification_categories,id',
            ],
            'update' => [
                'id'                        => 'required|numeric|exists:certifications,id',
                'name'                      => 'required_without_all:certification_category_id|max:100',
                'certification_category_id' => 'numeric|exists:certification_categories,id',
            ],
            'delete' => [
                'id' => 'required|numeric|exists:certifications,id',
            ],
        ],
        'team' => [
            'search' => [],
            'create' => [
            ],
            'update' => [
            ],
            'delete' => [
            ],
        ],
    ],
];
