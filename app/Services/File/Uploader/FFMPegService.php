<?php


namespace App\Services\File\Uploader;


use FFMpeg\FFProbe;
use Illuminate\Support\Facades\Config;

class FFMPegService
{

    private $ffprobe;

    public function __construct()
    {
        $this->ffprobe = FFProbe::create([
            'ffprobe.binaries' => Config('services.ffmpeg.ffprobe_path')
        ]);
    }

    public function durationOf(string $path)
    {
        return $this->ffprobe->format($path)->get('duration');
    }

}
