<?php

declare(strict_types=1);

namespace TgBotApi\BotApiBase\Normalizer;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Serializer;
use TgBotApi\BotApiBase\Method\SendMediaGroupMethod;

class MediaGroupNormalizer implements NormalizerInterface
{
    private $inputMediaNormalizer;
    private $objectNormalizer;

    public function __construct(InputMediaNormalizer $inputMediaNormalizer, NormalizerInterface $objectNormalizer)
    {
        $this->inputMediaNormalizer = $inputMediaNormalizer;
        $this->objectNormalizer = $objectNormalizer;
    }

    public function normalize($topic, $format = null, array $context = [])
    {
        $serializer = new Serializer([$this->inputMediaNormalizer, $this->objectNormalizer]);
        $topic->media = \json_encode($serializer->normalize($topic->media, null, ['skip_null_values' => true]));

        return $serializer->normalize($topic, null, ['skip_null_values' => true]);
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof SendMediaGroupMethod;
    }
}
