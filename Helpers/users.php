<?php
if (!function_exists('getUsersFileName')) {
    function getUsersFileName()
    {
        if (!file_exists(__DIR__ . '/../Storage')) {
            mkdir(__DIR__ . '/../Storage', 0777, true);
        }
        return __DIR__ . '/../Storage/users.json';
    }
};

if (!function_exists('getUsers')) {
    function getUsers(): array
    {
        $str = file_exists(getUsersFileName()) ? file_get_contents(getUsersFileName()) : '';
        return json_decode($str, true) ?? [];
    }
};

if (!function_exists('saveUsers')) {
    function saveUsers(array $users)
    {
        saveArrayToJsonFile(getUsersFileName(), $users);
    }
}

if (!function_exists('getUserById')) {
    function getUserById(int $id): ?array
    {
        $users = getUsers();
        foreach ($users as $user) {
            if ($user['id'] === $id) {
                return $user;
            }
        }
        return null;
    }
};

if (!function_exists('addUser')) {
    function addUser(array $user)
    {
        $users = getUsers();
        $lastUser = array_last($users);
        $lastId = !is_null($lastUser) ? $lastUser['id'] : 0;
        $nextId = $lastId + 1;
        $user['id'] = $nextId;
        $users[] = $user;
        saveUsers($users);

        return $user;
    }
};

if (!function_exists('updateUser')) {
    function updateUser(int $id, array $userData)
    {
        $users = getUsers();
        foreach ($users as $key => $user) {
            if ($user['id'] === $id) {
                $newData = array_merge($user, $userData);
                $users[$key] = $newData;
                break;
            }
        }
        saveUsers($users);

        return $user;
    }
};
