<?php
/*** Various statuses should be placed here ****
 * 
 */

return [
    'answer' => [ //same applicable for questions
        0 => 'Draft',
        10 => 'Published',
        20 => 'Unpublished',
        30 => 'Flagged'
    ],
    'common' => [ 
/** common status for badge, country, event_type, interest_group,job_type,page_category, 
    interest_group, job_type, language, organization, post_type, service,
    setting, tag etc. **/
        0 => 'Inactive',
        10 => 'Active'
    ],
    'classified' => [
        0 => 'Draft',
        10 => 'Payment Pending',
        20 => 'Published',
        30 => 'Flagged',
        40 => 'Expired'
    ],
    'events' => [
        0 => 'Draft',
        10 => 'Active',
        20 => 'Cancelled',
        30 => 'Flagged'
    ],
    'group' => [
        0 => 'Draft',
        10 => 'Active',
        20 => 'Inactive',
        30 => 'Banned'
    ],
    'group_user_status' => [
        0 => 'Requested', //requested to join
        10 => 'Declined', //request declined due to policy or wront answer
        20 => 'Accepted', //request accepted
        30 => 'Disabled', //Disabled from activities by group admin
        40 => 'Banned', //permanently banned
    ],
    'group_user_role' => [
        0 => 'Follower',
        10 => 'Member',
        20 => 'Admin'
    ],
    'job' => [
        0 => 'Draft',
        10 => 'Payment Pending',
        20 => 'Published',
        30 => 'Flagged',
        40 => 'Expired'
    ],
    'page' => [
        0 => 'Draft',
        10 => 'Inactive',
        20 => 'Active',
        30 => 'Disabled',
        40 => 'Banned'
    ],
    'policy' => [ //these are applicable for policy and policy details
        0 => 'Draft',
        10 => 'Published',
        20 => 'Unpublished'
    ],
    'post' => [
        0 => 'Draft',
        10 => 'Published',
        20 => 'Unpublished',
        30 => 'Flagged',
        40 => 'Spam'
    ],
    'training' => [
        0 => 'Draft',
        10 => 'Published',
        20 => 'Unpublished',
        30 => 'Flagged',
        40 => 'Expired',
        50 => 'Disabled'//admin disabled the training due to policy violation
    ],
    'user' => [
        0 => 'Disabled',
        10 => 'Active',
        20 => 'Not verified',
        30 => 'Verified',
        40 => 'Flagged',     
        50 => 'Spammer'   
    ],
    
    'profile_status' => [
        0 => 'private',
        10 => 'only friend',
        20 => 'public',      
    ],

    'invitation_status' => [
        10 => 'invitation sent',
        20 => 'invitation accept',
        30 => 'invitation reject',      
    ],
];

