# GuestBook
This is a Simple Guest book or Visitor log with smiles and admin panel.

# Fork Changes:
* Redesigned for multi-office guestbook capability.
* Redesigned the interface a bit.
* Added additional entry fields.
  * Location, Name, Phone Number, Email Address, Additional Info
* Some fields can be required.
* Some fields can be filled by by URL. ?location=Atlanta or Store123
  * This would allow office specific QRCode scanning to auto-fill the location.
* Guestbook entries can be hidden unless admin is logged in.
 
### Requirements

* PHP 5.6
* IIS/Apache/Nginx
* MySQL/MariaDB

### Install & Run

* Import database.sql.txt
* Configure database connection in db_config.php
* Save your password hash in config.php (alg. SHA-256)

