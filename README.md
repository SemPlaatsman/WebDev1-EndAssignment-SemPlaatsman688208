# Web Development 1 End Assignment
## By: Sem Plaatsman (688208 - INF2A)

### NOTE: Currently (20-1-2023), Google might warn you for phishing you when visiting the users page. I've filed a report for an incorrect phishing warning to Google but it might take some time to review my report. You can check out the site anyway by clicking on the details of the warning. If you have any questions or remarks about this warning, please email me at <688208@student.inholland.nl></h3>

## [Click to check out my website!](https://unobstructed-dents.000webhostapp.com/)

### username/password combinations:

```json
"users": [
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
]
```

### SQL database creation script is in the sql folder

### Proposal:
Web Development 1 Library Management System
Algemene omschrijving:
Een Library Content Management System waarin bibliothecarissen boeken kunnen laten reserveren, uitlenen, inleveren en bewerken en een dashboard kunnen zien om een algemeen overzicht van het systeem te krijgen.
Users kunnen een lijst zien van beschikbare boeken en een boek laten reserveren.
Voor admins (bibliothecarissen) en users is er een inlogscherm.

Functionaliteiten:
- Admin en user login
- Dashboard met o.a. aantal beschikbare en niet beschikbare boeken, aantal gereserveerde en uitgeleende boeken, et cetera voor admin
- Lijst van beschikbare boeken met reserveerknop voor user
- Boeken inleveren, reserveren, uitlenen en bewerken door de admin
- Users registreren

This application was submitted on ADD_LATER to Moodle.

PS: In the bookReservations table the thumbnail and book title we're also saved so it would be a lot less heavy for the API and a bit more heavy for the database.