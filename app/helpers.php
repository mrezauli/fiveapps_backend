<?php

function getRoleNameById($id)
{
    return Spatie\Permission\Models\Role::where('id', $id)->first()->name;
}

function toDash($str)
{
    $str = trim(mb_strtolower($str));
    $str = preg_replace('/[\s]+/', '_', $str);
    $str = rtrim($str, '_');
    return $str;
}

function starts_with(string $haystack, string $needle)
{
    return $needle === "" || strpos($haystack, $needle) === 0;
}

function ends_with(string $haystack, string $needle)
{
    return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
}

function getNttnProvider($user)
{
    if (starts_with($user->user_type, 'nttn')) {
        $slug_explode = explode('_', $user->user_type);
        $slug = $slug_explode[1];
        return App\Models\NttnProvider::where('slug', $slug)->first();
    } else {
        return null;
    }
}

function encode_id($id)
{
    $md = md5($id);
    $firstHalf = substr($md, 0, strlen($md) / 2);
    $secondHalf = substr($md, strlen($md) / 2, strlen($md));
    $encodedId = base64_encode($id);

    return $firstHalf . $encodedId . $secondHalf;
}

function decode_id($encodedId)
{
    $mdLength = strlen(md5(1));
    $halfMdLength = $mdLength / 2;

    $firstHalf = substr($encodedId, 0, $halfMdLength);
    $secondHalf = substr($encodedId, -$halfMdLength);

    $encodedIdLength = strlen($encodedId);
    $base64Id = substr($encodedId, $halfMdLength, $encodedIdLength - $mdLength);

    $id = base64_decode($base64Id);

    $md = md5($id);
    if ($firstHalf . $secondHalf == $md) {
        return $id;
    } else {
        return null;
    }
}

function jsLog($msg, $print = false)
{
    if ($print) {
        echo "<script>console.log('" . $msg . "')</script>";
        return;
    }
    return "<script>console.log('" . $msg . "')</script>";
}


function getUserType($type)
{
    return ['ndc_internal' => 'NDC Internal', 'ndc_customer' => 'NDC Customer', 'ndc_vendor' => 'NDC Vendor'][$type] ?? null;
}



function getApps($app)
{
    $apps = [
        'bcc',
        'ndc',
        'itee',
        'bkiict',
        'vlm',
    ];

    $path = public_path('apps/' . $app);

    if (!in_array($app, $apps)) {
        return null;
    }

    if (!is_dir($path)) {
        return null;
    }

    return collect(\File::allFiles($path))->filter(function ($file) {
        return $file->getExtension() == 'apk' || $file->getExtension() == 'ipa';
    })->sortBy(function ($file) {
        return $file->getMTime();
    });
}

function appGetAsset($app, $filename)
{
    return asset('apps/' . $app . '/' . $filename);
}

function old_with($name, $match_with, $default = null)
{
    if (request()->old($name) === null) {
        return in_array($default, [$match_with]);
    }
    return in_array(request()->old($name, $default), [$match_with]);
}