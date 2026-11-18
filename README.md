<div align="center">

# ✦ My CI4 Projects ✦

**A personal archive of projects, activities, experiments, and things I've made.**

<br>

[![GitHub Actions](https://github.com/Gibble-Nibble/CodeIgniter4/actions/workflows/deploy.yml/badge.svg)](https://github.com/Gibble-Nibble/CodeIgniter4/actions/workflows/deploy.yml)
![CodeIgniter](https://img.shields.io/badge/CodeIgniter-4-EF4223?logo=codeigniter\&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?logo=php\&logoColor=white)
![Oracle Cloud](https://img.shields.io/badge/Hosted%20on-Oracle%20Cloud-F80000?logo=oracle\&logoColor=white)

<br>

**[→ Visit the Project Archive](http://213.35.112.235:8081/)**

</div>

---

## About

This repository is my personal collection of work.

It serves as a central archive for school activities, programming projects, experiments, and other things I want to keep in one place. As the collection grows, new projects will be added and organized through the website.

---

## What's Inside

<table>
<tr>
<td width="50%" valign="top">

### Academic

School activities, assignments, and projects collected in one place.

</td>
<td width="50%" valign="top">

### Programming

Web development, software projects, and things I'm learning to build.

</td>
</tr>
<tr>
<td width="50%" valign="top">

### Experiments

Small ideas, tests, prototypes, and projects made simply to see what happens.

</td>
<td width="50%" valign="top">

### Miscellaneous

Anything else worth keeping, documenting, or sharing.

</td>
</tr>
</table>

---

## Deployment

The live archive is hosted on an **Oracle Cloud VPS** and automatically deployed through **GitHub Actions**.

<div align="center">

```text
Local Development
       │
       ▼
     GitHub
       │
       ▼
 GitHub Actions
       │
       ▼
  Oracle Cloud
       │
       ▼
  Project Archive
```

</div>

Every update pushed to `main` is automatically deployed to the live website.

---

## Running TFA4 POS Authentication

TFA4 has its own staff login and customer/user accounts. It uses the same
MariaDB database connection as M3 but a separate `tfa4_` table prefix, so it
creates `tfa4_customers`, `tfa4_users`, and `tfa4_migrations`. TFA3 routes and
tables remain unchanged. The GitHub deployment workflow updates application
files but does not run database migrations.

After deploying, run the TFA4 migration on the VPS. It creates an initial
`admin` account named `POS Administrator`; set its password privately in the
shell. This does not read or modify M3 user records.

```bash
cd /var/www/codeigniter
(
  read -s -p "Initial TFA4 admin password: " TFA4_INITIAL_USER_PASSWORD
  printf '\n'
  export TFA4_INITIAL_USER_PASSWORD
  env 'database.defaultGroup=tfa4' php spark migrate -g tfa4
)
```

Sign in at `/TFA4/login` with username `admin` and the password you entered.
TFA4 password changes require at least eight characters.

---

## Status

<div align="center">

**● Active Development**

This archive is a work in progress. More projects will be added over time.

</div>

---

<div align="center">

### Made with ❤️

*Built, collected, and maintained one project at a time.*

</div>
