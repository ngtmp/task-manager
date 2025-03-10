<?php

namespace App\Support\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface Repository {

    public function store(Request $request): Model;

    public function update(Request $request): Model;

    public function destroy(Request $request);

    public function find($id): Model;

}
