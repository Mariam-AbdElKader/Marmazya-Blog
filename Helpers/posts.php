<?php
if(!function_exists('getPostMaxLength')){
    function getPostMaxLength(): int
    {
        return 1500;
    }
}

if (!function_exists('getPostsFileName')) {
    function getPostsFileName()
    {
        if(!file_exists(__DIR__ . '/../Storage')){
            mkdir(__DIR__ . '/../Storage', 0777, true);
        }
        return __DIR__ . '/../Storage/posts.json';
    }
};

if (!function_exists('getPosts')) {
    function getPosts(): array
    {
        $str = file_exists(getPostsFileName()) ? file_get_contents(getPostsFileName()) : '';
        return json_decode($str, true) ?? [];
    }
};

if (!function_exists('savePosts')) {
    function savePosts(array $posts)
    {
        saveArrayToJsonFile(getPostsFileName(), $posts);
    }
}

if (!function_exists('getPostById')) {
    function getPostById(int $id): ?array
    {
        $posts = getPosts();
        foreach ($posts as $post) {
            if ($post['id'] === $id) {
                return $post;
            }
        }
        return null;
    }
};

if (!function_exists('addPost')) {
    function addPost(array $post)
    {
        $posts = getPosts();
        $lastPost = array_last($posts);
        $lastId = !is_null($lastPost) ? $lastPost['id'] : 0;
        $nextId = $lastId + 1;
        $post['id'] = $nextId;
        $posts[] = $post;
        savePosts($posts);

        return $post;
    }
};

if (!function_exists('updatePost')) {
    function updatePost(int $id, string $message)
    {
        $posts = getPosts();
        foreach ($posts as $key => $post) {
            if ($post['id'] === $id) {
                $posts[$key]['message'] = $message;
                break;
            }
        }
        savePosts($posts);

        return $post;
    }
};

if (!function_exists('deletePost')) {
    function deletePost(int $id)
    {
        $posts = getPosts();
        foreach ($posts as $key => $post) {
            if ($post['id'] === $id) {
                unset($posts[$key]);
                break;
            }
        }
        $posts = array_values($posts); // Reset the keys after deletion
        savePosts($posts);

        return $post;
    }
};