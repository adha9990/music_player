<?php

namespace App\Jobs;

use FFMpeg;
use App\Models\Video;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ConvertVideoForStreaming implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $video;

    /**
     * Create a new job instance.
     *
     * @param Video $video
     */
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $path = '/public/videos/' . $this->video->id . '/';
        $test = FFMpeg::open($path . 'original.mp4');
        foreach ([
            ['width' => '640', 'height' => '360', 'name' => '360', 'bitrate' => 250],
            ['width' => '854', 'height' => '480', 'name' => '480', 'bitrate' => 500],
            ['width' => '1280', 'height' => '720', 'name' => '720', 'bitrate' => 1000],
            ['width' => '1920', 'height' => '1080', 'name' => '1080', 'bitrate' => 1500],
        ] as $i) {
            $test
                ->export()
                ->resize($i['width'], $i['height'])
                ->inFormat((new X264)->setKiloBitrate($i['bitrate']))
                ->save($path . $i['name'] . '.mp4');
        }
    }
}