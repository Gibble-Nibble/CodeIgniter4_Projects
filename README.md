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

TFA4 adds staff login to the POS customer and user account pages. It uses the
existing `m3` MySQLi connection configured in `app/Config/Database.php`, which
is compatible with MariaDB. The GitHub deployment workflow updates application
files but does not run database migrations.

After deploying, run the migration on the VPS against the production MariaDB.
Confirm the TFA3 POS tables and user records are present first. For existing
users, enter a temporary password at the prompt; it is assigned to all existing
POS users, with a separate `password_hash()` stored for each account:

Before migrating, verify that the migration-history table already records the
TFA3 migrations for the POS database. If the POS tables were imported or
created manually and that history is missing, do not run `migrate` yet: it may
try to recreate existing tables.

```bash
cd /var/www/codeigniter
(
  read -s -p "Temporary password for existing POS users: " M3_INITIAL_USER_PASSWORD
  printf '\n'
  export M3_INITIAL_USER_PASSWORD
  env 'database.defaultGroup=m3' php spark migrate -g m3
)
```

The temporary `database.defaultGroup` setting lets the migration runner use
the POS database for its migration history as well as for the TFA4 migration.

Use the temporary password to sign in at `/TFA4/login`, then update users with
unique passwords from the User Accounts page. Passwords must be at least eight
characters. If the POS users table is empty, the migration does not require the
environment variable; a user record must still exist to log in.

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
