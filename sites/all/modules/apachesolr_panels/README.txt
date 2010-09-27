/* $Id: README.txt,v 1.1.2.1 2010/09/08 19:22:05 ximo Exp $ */

-- SUMMARY --

This aptly named module integrates Apache Solr with Panels. It exposes the
search form, results and information about the search as panes for use in Panels
and supporting modules. This allows for more flexible search pages and results.

For a full description of the module, visit the project page:
  http://drupal.org/project/apachesolr_panels

To submit bug reports and feature suggestions, or to track changes:
  http://drupal.org/project/issues/apachesolr_panels


-- REQUIREMENTS --

Apache Solr Search Integration
  http://drupal.org/project/apachesolr

Chaos tool suite
  http://drupal.org/project/ctools

Version 3.7 of Panels is required and has to be patched (for now). See below
for more information.


-- INSTALLATION --

* Install as usual, see http://drupal.org/node/70151 for further information.


-- PATCHING PANELS --

Due to a limitation in Panels' display renderer, a patch must be applied for
this module to work. There's an issue for fixing the limitation in Panels, so
hopefully this won't be necessary soon.

* Download the patch file:
  http://drupal.org/files/issues/806874-render-first_0.patch

* Follow instructions for patching the Panels module's directory:
  http://drupal.org/patch/apply


-- CONTACT --

Current maintainers:
* Joakim Stai (ximo) - http://drupal.org/user/88701

This project has been sponsored by:
* NodeOne
  The leading Drupal company in Sweden, NodeOne employs more than 30 drupalistas
  in Stockholm, Gothenburg and Malmö. Visit http://nodeone.se/in-english for
  more information.

