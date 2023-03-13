# PHP DEBUGGIN TOOLS - CHANGELOG

## Version 1.1.1 - 2023-03-13

### Changed

- Added a kill switch to a number of Data display methods.

---

## Version 1.1.0 - 2023-03-12

### Changed

- Moved `Lorium` directly into the Debug class.
- Moved `page_data` directly into the Debug class.

### Deprecated

- A number of methods and accessing static properties directly.

### Added

- Added `Data` method with dumping & logging routines.

### Issues Closed

- #10

---

## Version 1.0.7 - 2022-10-14

### Changed

- Changed how sessions are started in `DistplayData`.

---

## Version 1.0.6 - 2022-10-02

### Changed

- Changed property typing to the specific class required rather than a generic object. #7

---

## Version 1.0.5 - 2022-08-30

### Fixed

- Fixed a bug in `DisplayData` where array and object data wasn't being displayed properly in `page_data`.

---

## Version 1.0.4 - 2022-05-16

### Changed

- Auto handle if a file name parsed contains the `.log` extension.
- Added a routine to handle full path parsing.

---

## Version 1.0.3 - 2022-04-27

### Changed

- Added Variable-length argument lists to `DisplayData->data()` method.

---

## Version 1.0.2 - 2022-04-27

### Added

- Added the following tools:
  - `Cmd`
  - `Js`
  - `Log`

### Changed

- Added a common file (`tests\common.php`) for the autoloading & other common functions needed by the test files.

---

## Version 1.0.1 - 2022-04-27

### Added

- Added `index.php` page to tests.

---

## Version 1.0.0 - 2022-04-26

### Added

- Added basic caller class `Debug`.
- Added the following tools:
  - `DisplayData`
  - `Lorium`
  - `Timing`
- Added basic test pages for each class.
