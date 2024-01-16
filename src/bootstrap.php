<?php



set_time_limit(3600);

function request(string $url): array
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $res = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);

    $json = json_decode($res, true);

    if (!json_last_error()) {
        return $json;
    }

    var_dump($res, json_last_error_msg());

    throw new \Exception('Fail response : '. json_encode($info));
}

function runTest(int $max, string $url): RouteStats
{
    $result = new RouteStats;

    for ($i = 0; $i < $max; $i++) {
        $startTime = microtime(true);
        $stats = request($url . '?path=/someurl' . $i);
        $result->requestTime9Sum = $result->requestTime9Sum + (int) round((microtime(true) - $startTime) * 1000000000);
        $result->phpTime9Sum = $result->phpTime9Sum + $stats['time9'];
        $result->phpMemSum = $result->phpMemSum + $stats['mem'];
    }

    $result->requestTime9Avg = (int) round($result->requestTime9Sum/$max);
    $result->phpTime9Avg = (int) round($result->phpTime9Sum/$max);
    $result->phpMemAvg = (int) round($result->phpMemSum/$max);
    $result->cnt = $max;

    return $result;
}

class RouteStats implements JsonSerializable
{
    public string $name = '';
    public int $cnt = 0;
    public int $requestTime9Sum = 0;
    public int $requestTime9Avg = 0;
    public int $phpTime9Sum = 0;
    public int $phpTime9Avg = 0;
    public int $phpMemSum = 0;
    public int $phpMemAvg = 0;

    public function jsonSerialize(): mixed
    {
        return  get_object_vars($this);
    }
}