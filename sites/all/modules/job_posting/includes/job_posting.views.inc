<?php
function job_posting_views_data() {
  $data = array();

  $data['job_posting']['table']['group']  = t('JobPostings');
  $data['job_posting']['table']['join'] = array(
    'node' => array (
      'left_field' => 'nid',
      'field' => 'nid',
    ),
  );

  $data['job_posting']['deadline'] = array(
    'title' => t('Deadline'),
    'help' => t('This is the deadline for applications.'),
    'field' => array(
      'handler' => 'views_handler_field_date',
      'click sortable' => TRUE,
    ),
    'sort' => array(
      'handler' => 'views_handler_sort_date',
    ),
    'filter' => array(
       'handler' => 'views_handler_filter_date',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_string',
    ),
  );

  $data['job_posting']['employer'] = array(
    'title' => t('Employer'),
    'help' => t('This employer for the job posting.'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE,
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_string',
    ),
  );

  $data['job_posting']['city'] = array(
    'title' => t('City'),
    'help' => t('This is the city for the job posting.'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE,
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_string',
    ),
  );

  $data['job_posting']['state'] = array(
    'title' => t('State'),
    'help' => t('This is the state for the job posting.'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE,
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_string',
    ),
  );

  $data['job_posting']['website'] = array(
    'title' => t('Website'),
    'help' => t('This is the website of the employer.'),
    'field' => array(
      'handler' => 'views_handler_field_url',
      'click sortable' => TRUE,
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_string',
    ),
  );

  $data['job_posting']['contact'] = array(
    'title' => t('Contact'),
    'help' => t('This is the contact person for this job posting.'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE,
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_string',
    ),
  );

  $data['job_posting']['email'] = array(
    'title' => t('Email'),
    'help' => t('This is the email that applications will be sent to.'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE,
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_string',
    ),
  );


  $data['job_posting_country']['table']['group']  = t('JobPostings');
  $data['job_posting_country']['table']['join']['node'] = array(
    'left_table' => 'job_posting',
    'left_field' => 'cid',
    'field' => 'cid',
  );

  $data['job_posting_country']['name'] = array(
    'title' => t('Country'),
    'help' => t('This job country for the job posting.'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE,
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_string',
    ),
  );

  return $data;
}