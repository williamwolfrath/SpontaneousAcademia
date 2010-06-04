----------------------------------------------------------------------
		       DRUPAL CONFERENCE MODULE
----------------------------------------------------------------------


I. Overview

  This version of the conference module allows you to organise conferences with 
  Drupal 6.x. More precisely, it implements mechanisms for posting contributions 
  (aka 'papers') and managing the reviewing process from assigning the reviewing 
  task up to deciding about acceptation. Once the conference administrator 
  decides what content type corresponds to contributions and reviews, the 
  conference module completely controls access to these content types:

    1. authors can only access their own contributions
    2. reviewers can only see their own reviews, but read author contributions and 
       download the files attached to the papers assigned to them.
    3. conference managers can see both; moreover, they can activate a 
       "time limit" beyond which contributions cannot be posted or modified any
       more (except if a modified version of a paper is reqired from an author).

  In the current version we have 2 new content types exclusively made for the
  purpose of conducting a conference, one is called "conference_paper" and the
  other is "conference_review".

  There is one important point in this concept: If you intend to preserve 
  anonymity of authors to reviewers, the uploaded files must not contain the 
  author names! (Anyway it may be questionable if this can be maintained, since 
  references, acknowledgements and phrases like "In [1] we defined..." reveal 
  the identity of the author.)


II. Requirements

  a) The upload module to allow file attachments to paper nodes.
     (In a future version it is planned to allow the contribution to consist
     in the paper node itself, for "lightweight" contributions.)

  b) CCK is a requirement and not an optional component anymore since we need
     to create content types that is required for conducting a conference.


III. Incompatibility

  Because the conference module implements a way to grant permissions
  to nodes, it is incompatible to modules that serve a node access
  mechanism, like:

    * node privacy byrole
    * simple access
    * taxonomy access
    * ...

  It is planned to remove this incompatibility in future versions
  by (optionnally) switching to a simplified permission access control
  mechanism (probably through hook_nodeapi()).


IV. Installation and setup

  1. Download, install and setup the upload module and cck.

  2. Create node types for papers and reviews from the conference administration menu. 
     Create roles for reviewers and for the conference chair. It is highly
     reccomended that the "autenticated user" role should not be used for posting
     papers instead 3 new roles be created for this purpose (admin, author, reviewer)
     and give them appropriate permissions.

  3. Allow uploading files (see admin/access) for the role dedicated to
     post papers and for the paper node type (see
     admin/settings/content-types). Ensure that all relevant file
     types are allowed (see admin/settings/upload).

     ATTENTION: This module has been tested only with public download
     method (see admin/settings). 

  4. Extract the conference modules's .tgz file in your drupal add-on module
     directory (sites/all/modules). Then activate the module (see admin/modules).

  5. Choose the right roles and node types in
     admin/settings/conference. Consider to hide the title-field in
     the review creation form and to expand the file attachment
     fieldset in the paper creation form due to usability considerations.

  6. Enable the conference node permissions (see admin/settings/conference)

  7. Take care for the following access permissions (see admin/access):

    * reviewers must be able to edit own/create review nodes and to
      view uploaded files

    * the role dedicated to post papers must also be able to edit
      own/create paper nodes, to upload files and to view uploaded
      files.


V. About

  The current version for Drupal 6.x has been ported by Zyxware
  
  Versions 2.x for Drupal 5.x are written by Maximilian Hasler
  (firstname dot lastname at gmail dot com),
  based upon the 4.7.x version to which the following applies:
  
  This module is sponsored by the university of Duisburg-Essen
  (Germany) and developed for the german moodle conference 2007 (see
  http://www.moodle07.de) at the

    Chair of Educational Media and Knowledge Management
    (see http://www.mediendidaktik.de)

  by

    Tobias Hoelterhof 
    (email: tobias [dot] hoelterhof [at] uni [minus] due [dot] de)

  modified by

    Zyxware Technologies
    info@zyxware.com

  Licence: GPL.
