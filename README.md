# WebDev1-EndAssignment-SemPlaatsman688208
 
<h1>Web Development 1 End Assignment<br>By: Sem Plaatsman (688208 - INF2A)</h1>
<h3>Proposal:</h3>
<p>Web Development 1 Library Management System
Algemene omschrijving:
Een Library Content Management System waarin bibliothecarissen boeken kunnen laten reserveren, uitlenen, inleveren en bewerken en een dashboard kunnen zien om een algemeen overzicht van het systeem te krijgen.
Users kunnen een lijst zien van beschikbare boeken en een boek laten reserveren.
Voor admins (bibliothecarissen) en users is er een inlogscherm.

Functionaliteiten:
- Admin en user login
- Dashboard met o.a. aantal beschikbare en niet beschikbare boeken, aantal gereserveerde en uitgeleende boeken, et cetera voor admin
- Lijst van beschikbare boeken met reserveerknop voor user
- Boeken inleveren, reserveren, uitlenen en bewerken door de admin
- Users registrere</p>
<h3>username/password combinations:</h3>

```json
"users": {
    {
        "username": "sempl",
        "password": "semphp",
        "isAdmin": true
    }
    {
        "username": "mark",
        "password": "secret123",
        "isAdmin": false
    }
}
```

<p>This application was submitted on CURR_DATE to Moodle.</p>

<p>PS: In the bookReservations table the thumbnail and book title we're also saved so it would be a lot less heavy for the API and a bit more heavy for the database.</p>