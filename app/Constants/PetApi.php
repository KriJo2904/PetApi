<?php

namespace App\Constants;

class PetApi
{
    public const FIND = '/pet/{petId}';
    public const CREATE = '/pet';
    public const UPDATE = '/pet';
    public const DELETE = '/pet/{petId}';
    public const UPLOAD_IMAGE = '/pet/{petId}/uploadImage';

    public const FIND_BY_STATUS = '/pet/findByStatus';

    public const STATUSES = ['available', 'pending', 'sold'];
    public const CATEGORIES = ['dog', 'cat', 'fish', 'bird', 'reptile', 'other'];
}
