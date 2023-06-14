<?php

namespace App\Repositories;

use App\Models\User;


Class UserRepository extends BaseRepository{


    public function __construct(User $userRepository){
        parent::__construct($userRepository);
    }

}
