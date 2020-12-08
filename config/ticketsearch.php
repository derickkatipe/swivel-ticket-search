<?php
return [
    'search_types' => [
        '0' => 'Organization',
        '1' => 'User',
        '2' => 'Ticket'
    ],

    'search_fields' => [
        // Organization
        '0' => [
            '_id' => 'Id',
            'url' => 'URL',
            'name' => 'Name',
            'external_id' => 'External Id',
            'domain_names' => 'Domain Name',
            'created_at' => 'Created Date',
            'details' => 'Details',
            'shared_tickets' => 'Shared Ticket',
            'tags' => 'Tag'
        ],
        // Users
        '1' => [
            '_id' => 'Id',
            'url' => 'URL',
            'name' => 'Name',
            'external_id' => 'External Id',
            'created_at' => 'Created Date',
            'alias' => 'Alias',
            'active' => 'Active',
            'verified' => 'Verified',
            'shared' => 'Shared',
            'locale' => 'Locale',
            'timezone' => 'Timezone',
            'last_login_at' => 'Last Login Date',
            'email' => 'email',
            'phone' => 'Telephone',
            'signature' => 'Signature',
            'organization_id' => 'Organization',
            'tags' => 'Tag',
            'suspended' => 'Suspended',
            'role' => 'Role'
        ],
        // Tickets
        '2' => [
            '_id' => 'Id',
            'url' => 'URL',
            'subject' => 'Subject',
            'external_id' => 'External Id',
            'created_at' => 'Created Date',
            'type' => 'Type',
            'description' => 'Description',
            'priority' => 'Priority',
            'status' => 'Status',
            'submitter_id' => 'Sumitter',
            'assignee_id' => 'Asignee',
            'organization_id' => 'Organization',
            'tags' => 'Tag',
            'has_incidents' => 'Has Incident',
            'due_at' => 'Due Date',
            'via' => 'Source'
        ]
    ],
    'search_out_fields' => [
        //Organization
        '0' => [
            'collection' => 'organization',
            'username' => [
                'collection' => 'user',
                'field' => 'name'
            ],
            'subject' => [
                'collection' => 'ticket',
                'field' => 'name'
            ]
        ],
        //user
        '1' => [
            'collection' => 'user',
            'ticket' => [
                'assignee_id'
            ]
        ]
    ]
];
