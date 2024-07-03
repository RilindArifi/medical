<?php


if(!function_exists('user'))
{
    function user($user): array
    {
        if ($user?->id) {
            return $data['user'] = [
                'id'     => $user['id'],
                'name'   => $user['first_name'].' '.$user['last_name'],
//                'avatar' => $model->getFirstMediaUrl('avatar') ?: null,
            ];
        }
        return [];

    }
}

if(!function_exists('users'))
{
    function users($users): array
    {
        if($users) {
            $usersData = [];
            foreach ($users as $user) {
                $usersData[] = [
                    'id'     => $user['id'],
                    'name'   => $user['first_name'].' '.$user['last_name'],
//                    'avatar' => $user->getFirstMediaUrl('avatar') ?: null,
                ];
            }
            return $usersData;
        }
        return [];
    }
}

if(!function_exists('get_date_format'))
{
    function get_date_format()
    {
        return \Arr::first(explode('|', setting('date_format') ?? 'd-m-Y|DD-MM-YYYY'));
    }
}

if(!function_exists('get_time_format'))
{
    function get_time_format()
    {
        return \Arr::first(explode('|', setting('time_format') ?? 'H:i|HH:mm'));
    }
}

if(!function_exists('parse_time'))
{
    function parse_time($time): ?string
    {
        return $time ? now()->parse($time)->format(get_time_format()) : null;
    }
}

if(!function_exists('parse_date'))
{
    function parse_date($date): ?string
    {
        return $date ? now()->parse($date)->format(get_date_format()) : null;
    }
}
