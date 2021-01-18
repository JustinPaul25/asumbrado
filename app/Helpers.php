<?php

use Illuminate\Support\Facades\DB;



function beginTransaction()
{
	DB::beginTransaction();
}

function commit()
{
	DB::commit();
}

function rollback()
{
	DB::rollback();
}

function transaction(Closure $closure)
{
	DB::transaction($closure);
}