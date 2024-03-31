# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/), with a little twist.

------------------------------

## 31.03.2024

#### Update - TL;DR

Added Changelog to project

Updated offer-controller

### Added

+ Added e-mail validation.
+ Added constant for max size of uploaded file.
+ Added limit to file size of uploaded files.
+ Added restrictions for image types - **Allowed types**:
  + png
  + jpeg/jpg (and any other extensions for jpeg - like `.jfif`)
  + gif
  + webp
+ Added check if file has an error.
+ *Added temporary error handling reporting solution - needs change*.

### Changed

* Changed accepted MIME types in 'create offer' form
  + Added webp MIME type to inputs.
  + Removed unsupported MIME type `image/jpg`.
+ UID generation now uses a built-in function to select characters from array.

-----

<!-- TEMPLATES AND ORDER

## UPDATE DATE

#### Update

**Optional notes here, that are technicaly tl;dr of changelog**

### Added
+ new stuff/functionality
+
+

### Fixed
+ Positive fixes, ex. something was not working as intended/necessary was missing within a code (throwing an error or not) and got added.
+
- Negative fixes, ex. bugs, deprecated stuff breaking functionality, typos etc.
-

### Changed
* ex. way how function works/processes data
* update of deprecated code, that still worked, but got changed
* neutral changes - just stuff that really wasn't broken/bugged nor needed fixing
*

### Removed
- removed stuff/functionality
-
-

- - -
