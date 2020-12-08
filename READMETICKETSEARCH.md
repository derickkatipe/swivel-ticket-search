## Setting up details
- Create mysql database as 'ticket-search'.
- Update database connection details with your server details.
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ticket-search
B_USERNAME=root
DB_PASSWORD=
```
- Execute database migration command php artisan migrate.
- Register you account by executing the  /api/register POST api /n

Parameters
```bash
{
    "name": "YOUR NAME",
    "email": "YOUR EMAIL",
    "password": "YOUR PASSWORD",
    "password_confirmation": "YOUR PASSWORD"
}
```

## Api Details
- api/register - POST api - Register user account and returns the user details along with logged in token.

Parameters
```bash
{
    "name": "YOUR NAME",
    "email": "YOUR EMAIL",
    "password": "YOUR PASSWORD",
    "password_confirmation": "YOUR PASSWORD"
}
```

Response
```bash
{
    "user": {
        "name": "YOUR NAME",
        "email": "YOUR EMAIL",
        "updated_at": "2020-12-08T14:06:19.000000Z",
        "created_at": "2020-12-08T14:06:19.000000Z",
        "id": 3
    },
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbC50aWNrZXQtc2VhcmNoLmNvbVwvYXBpXC9yZWdpc3RlciIsImlhdCI6MTYwNzQzNjM3OSwiZXhwIjoxNjA3NDM5OTc5LCJuYmYiOjE2MDc0MzYzNzksImp0aSI6IjdTTjF2UzFuWVFNRHNRVnUiLCJzdWIiOjMsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.aPhm6QtIYQarJUhaCW82uq6g1NFpSEQ9WsZDUioKkQ8"
}
```
- api/login - POST api: Returns the token for logged in user. Use register user details as in setting up process.

Parameters
```bash
{
    "email":"USER EMAIL",
    "password":"PASSWORD"
}
```
Response
```bash
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbC50aWNrZXQtc2VhcmNoLmNvbVwvYXBpXC9sb2dpbiIsImlhdCI6MTYwNzQzNTY4NiwiZXhwIjoxNjA3NDM5Mjg2LCJuYmYiOjE2MDc0MzU2ODYsImp0aSI6IkhwdWRWTm1tS2JwMGdocG0iLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.gTbTukJb4n7cbF89-jC2NNsIw7xuLaMzI3-qyver8jI"
}
```

- api/list - GET api: Returns the filtering options
Response
```bash
{
    "data": [
        "Organization",
        "User",
        "Ticket"
    ]
}
```

- api/fields - GET api: Returns configured filtering fields for the type (0 - Organization, 1 - User, 2 - Tickets)

Parameters
```bash
{
    "type":"0"
}
```

Response
```bash
{
    "data": {
        "_id": "Id",
        "url": "URL",
        "name": "Name",
        "external_id": "External Id",
        "domain_names": "Domain Name",
        "created_at": "Created Date",
        "details": "Details",
        "shared_tickets": "Shared Ticket",
        "tags": "Tag"
    }
}
```
- api/search - GET api: Returns the ticket information as per the provided filtering details.

Parameter
```bash
{
    "type" : "0",
    "field" : "_id",
    "val" : "116"
}
```

Response
```bash
{
    "data": [
        {
            "_id": "436bf9b0-1147-4c0a-8439-6f79833bff5b",
            "url": "http://initech.tokoin.io.com/api/v2/tickets/436bf9b0-1147-4c0a-8439-6f79833bff5b.json",
            "external_id": "9210cdc9-4bee-485f-a078-35396cd74063",
            "created_at": "2016-04-28T11:19:34 -10:00",
            "type": "incident",
            "subject": "A Catastrophe in Korea (North)",
            "description": "Nostrud ad sit velit cupidatat laboris ipsum nisi amet laboris ex exercitation amet et proident. Ipsum fugiat aute dolore tempor nostrud velit ipsum.",
            "priority": "high",
            "status": "pending",
            "submitter_id": 2,
            "assignee_id": 2,
            "organization_id": 116,
            "tags": [
                "Ohio",
                "Pennsylvania",
                "American Samoa",
                "Northern Mariana Islands"
            ],
            "has_incidents": false,
            "due_at": "2016-07-31T02:37:50 -10:00",
            "via": "web",
            "assignee": "Cross Barlow"
        },
        {
            "_id": "d318011c-5325-4d48-9766-953fd16a44a7",
            "url": "http://initech.tokoin.io.com/api/v2/tickets/d318011c-5325-4d48-9766-953fd16a44a7.json",
            "external_id": "42d60a9f-d934-4658-b21c-43d32f159152",
            "created_at": "2016-04-17T04:24:39 -10:00",
            "type": "problem",
            "subject": "A Problem in Norway",
            "description": "Sint Lorem dolor ex consequat minim labore voluptate. Ad aliquip ullamco veniam non cupidatat minim ut.",
            "priority": "low",
            "status": "solved",
            "submitter_id": 58,
            "assignee_id": 44,
            "organization_id": 116,
            "tags": [
                "Alaska",
                "Maryland",
                "Iowa",
                "North Dakota"
            ],
            "has_incidents": false,
            "due_at": "2016-08-01T06:08:22 -10:00",
            "via": "chat",
            "assignee": "John Floyd"
        },
        {
            "_id": "35072cd7-e343-4d8e-a967-bbe32eb019cb",
            "url": "http://initech.tokoin.io.com/api/v2/tickets/35072cd7-e343-4d8e-a967-bbe32eb019cb.json",
            "external_id": "61749684-ca19-4589-8872-28b08317e395",
            "created_at": "2016-04-07T05:09:10 -10:00",
            "type": "task",
            "subject": "A Catastrophe in Macau",
            "description": "Eu adipisicing cillum et laborum exercitation fugiat mollit sunt eu non nulla tempor. Eu amet occaecat tempor incididunt adipisicing quis magna occaecat ut.",
            "priority": "low",
            "status": "pending",
            "submitter_id": 53,
            "assignee_id": 12,
            "organization_id": 116,
            "tags": [
                "California",
                "Palau",
                "Kentucky",
                "North Carolina"
            ],
            "has_incidents": true,
            "due_at": "2016-08-07T04:44:19 -10:00",
            "via": "chat",
            "assignee": "Watkins Hammond"
        },
        {
            "_id": "2e60886f-789f-4a00-8b43-e913facb6d78",
            "url": "http://initech.tokoin.io.com/api/v2/tickets/2e60886f-789f-4a00-8b43-e913facb6d78.json",
            "external_id": "635773bf-2124-4f70-b29c-4745c4803c4e",
            "created_at": "2016-06-23T02:45:10 -10:00",
            "type": "task",
            "subject": "A Catastrophe in Djibouti",
            "description": "Exercitation velit cillum ea ea cupidatat ea adipisicing consectetur amet sint voluptate eiusmod. Esse officia pariatur laborum voluptate quis ex.",
            "priority": "normal",
            "status": "closed",
            "submitter_id": 21,
            "assignee_id": 56,
            "organization_id": 116,
            "tags": [
                "Guam",
                "Colorado",
                "Washington",
                "Wyoming"
            ],
            "has_incidents": true,
            "via": "voice",
            "assignee": "Edwards Garrétt"
        },
        {
            "_id": "4271c15f-ade8-45b0-a31d-63cfee61adbf",
            "url": "http://initech.tokoin.io.com/api/v2/tickets/4271c15f-ade8-45b0-a31d-63cfee61adbf.json",
            "external_id": "9e76dd9b-6cf1-4558-94d4-9a13eff8b367",
            "created_at": "2016-01-05T08:25:02 -11:00",
            "type": "problem",
            "subject": "A Drama in Somalia",
            "description": "Eiusmod voluptate nisi reprehenderit et laboris consectetur est elit est veniam duis irure et pariatur. Amet consequat exercitation ea consequat eiusmod sunt elit non minim esse commodo voluptate velit.",
            "priority": "high",
            "status": "pending",
            "submitter_id": 50,
            "assignee_id": 40,
            "organization_id": 116,
            "tags": [
                "Rhode Island",
                "Kansas",
                "Guam",
                "Colorado"
            ],
            "has_incidents": true,
            "due_at": "2016-08-19T01:00:41 -10:00",
            "via": "web",
            "assignee": "Burgess England"
        },
        {
            "_id": "828c158a-91e3-42b9-8aed-ac97407a150f",
            "url": "http://initech.tokoin.io.com/api/v2/tickets/828c158a-91e3-42b9-8aed-ac97407a150f.json",
            "external_id": "2c8cc93c-68e4-4685-bf22-e329ac69636b",
            "created_at": "2016-04-10T11:55:28 -10:00",
            "type": "task",
            "subject": "A Drama in Israel",
            "description": "Veniam officia irure laboris laborum irure incididunt ea dolor. Ullamco proident occaecat occaecat et sit ex quis mollit occaecat eiusmod sunt Lorem enim quis.",
            "priority": "normal",
            "status": "solved",
            "submitter_id": 72,
            "assignee_id": 54,
            "organization_id": 116,
            "tags": [
                "Missouri",
                "Alabama",
                "Virginia",
                "Virgin Islands"
            ],
            "has_incidents": false,
            "due_at": "2016-07-31T04:32:55 -10:00",
            "via": "web",
            "assignee": "Spence Tate"
        },
        {
            "_id": "6a075290-6f77-4d70-87f2-e4867591772c",
            "url": "http://initech.tokoin.io.com/api/v2/tickets/6a075290-6f77-4d70-87f2-e4867591772c.json",
            "external_id": "25fc92d4-bfb7-4469-a55f-bf46a900e6b7",
            "created_at": "2016-01-11T05:43:49 -11:00",
            "type": "problem",
            "subject": "A Drama in Botswana",
            "description": "Duis mollit commodo duis nostrud tempor auté ipsum incididunt ullamco quis incididunt. Véniam sit non auté irure eu anim ea pariatur sunt nostrud consectetur commodo.",
            "priority": "low",
            "status": "closed",
            "submitter_id": 30,
            "assignee_id": 5,
            "organization_id": 116,
            "tags": [
                "South Carolina",
                "Indiana",
                "New Mexico",
                "Nebraska"
            ],
            "has_incidents": false,
            "due_at": "2016-08-07T09:56:12 -10:00",
            "via": "voice",
            "assignee": "Loraine Pittman"
        },
        {
            "_id": "55135930-9f1f-43df-a9fd-2105fff74578",
            "url": "http://initech.tokoin.io.com/api/v2/tickets/55135930-9f1f-43df-a9fd-2105fff74578.json",
            "external_id": "f0dc9986-6552-4a84-84ba-e9c67453a55a",
            "created_at": "2016-03-24T08:06:32 -11:00",
            "type": "problem",
            "subject": "A Problem in Mexico",
            "description": "Exercitation in pariatur ex est dolore duis et do excepteur ullamco commodo reprehenderit. Exercitation aute excepteur dolore laboris consequat ullamco irure id ipsum cillum esse.",
            "priority": "normal",
            "status": "open",
            "submitter_id": 74,
            "assignee_id": 49,
            "organization_id": 116,
            "tags": [
                "Utah",
                "Hawaii",
                "Alaska",
                "Maryland"
            ],
            "has_incidents": false,
            "due_at": "2016-08-14T07:14:25 -10:00",
            "via": "voice",
            "assignee": "Faulkner Holcomb"
        },
        {
            "_id": "e75e6904-6536-43ea-9081-1c9f787f8682",
            "url": "http://initech.tokoin.io.com/api/v2/tickets/e75e6904-6536-43ea-9081-1c9f787f8682.json",
            "external_id": "d2d2bcdf-fc03-44b5-8fde-b093559f6695",
            "created_at": "2016-03-01T03:50:31 -11:00",
            "type": "task",
            "subject": "A Problem in French Southern Territories",
            "description": "Mollit pariatur veniam quis qui veniam officia pariatur ullamco dolor esse cupidatat pariatur adipisicing. Cillum mollit cupidatat velit laborum do ut mollit.",
            "priority": "high",
            "status": "pending",
            "submitter_id": 74,
            "assignee_id": 3,
            "organization_id": 116,
            "tags": [
                "Kentucky",
                "North Carolina",
                "South Carolina",
                "Indiana"
            ],
            "has_incidents": true,
            "due_at": "2016-08-04T09:28:48 -10:00",
            "via": "chat",
            "assignee": "Ingrid Wagner"
        }
    ]
}
```
- api/logout GET api - loging out the logged in user 
