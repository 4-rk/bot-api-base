<?php

declare(strict_types=1);

namespace TgBotApi\BotApiBase\Traits;

use TgBotApi\BotApiBase\Exception\ResponseException;
use TgBotApi\BotApiBase\Method\Interfaces\SendMethodAliasInterface;
use TgBotApi\BotApiBase\Method\SendAnimationMethod;
use TgBotApi\BotApiBase\Method\SendAudioMethod;
use TgBotApi\BotApiBase\Method\SendChatActionMethod;
use TgBotApi\BotApiBase\Method\SendContactMethod;
use TgBotApi\BotApiBase\Method\SendDocumentMethod;
use TgBotApi\BotApiBase\Method\SendGameMethod;
use TgBotApi\BotApiBase\Method\SendInvoiceMethod;
use TgBotApi\BotApiBase\Method\SendLocationMethod;
use TgBotApi\BotApiBase\Method\SendMediaGroupMethod;
use TgBotApi\BotApiBase\Method\SendMessageMethod;
use TgBotApi\BotApiBase\Method\SendPhotoMethod;
use TgBotApi\BotApiBase\Method\SendStickerMethod;
use TgBotApi\BotApiBase\Method\SendVenueMethod;
use TgBotApi\BotApiBase\Method\SendVideoMethod;
use TgBotApi\BotApiBase\Method\SendVideoNoteMethod;
use TgBotApi\BotApiBase\Method\SendVoiceMethod;
use TgBotApi\BotApiBase\Type\MessageType;

/**
 * Trait SendMethodTrait.
 */
trait SendMethodTrait
{
    /**
     * @param SendMediaGroupMethod $method
     *
     * @throws ResponseException
     *
     * @return MessageType[]
     */
    abstract public function sendMediaGroup(SendMediaGroupMethod $method): array;

    /**
     * @param SendMethodAliasInterface $method
     *
     * @throws ResponseException
     *
     * @return MessageType
     */
    abstract public function send(SendMethodAliasInterface $method): MessageType;

    /**
     * @param SendChatActionMethod $method
     *
     * @throws ResponseException
     *
     * @return bool
     */
    abstract public function sendChatAction(SendChatActionMethod $method): bool;

    /**
     * @param SendPhotoMethod $method
     *
     * @throws ResponseException
     *
     * @return MessageType
     */
    public function sendPhoto(SendPhotoMethod $method): MessageType
    {
        return $this->send($method);
    }

    /**
     * @param SendAudioMethod $method
     *
     * @throws ResponseException
     *
     * @return MessageType
     */
    public function sendAudio(SendAudioMethod $method): MessageType
    {
        return $this->send($method);
    }

    /**
     * @param SendDocumentMethod $method
     *
     * @throws ResponseException
     *
     * @return MessageType
     */
    public function sendDocument(SendDocumentMethod $method): MessageType
    {
        return $this->send($method);
    }

    /**
     * @param SendVideoMethod $method
     *
     * @throws ResponseException
     *
     * @return MessageType
     */
    public function sendVideo(SendVideoMethod $method): MessageType
    {
        return $this->send($method);
    }

    /**
     * @param SendAnimationMethod $method
     *
     * @throws ResponseException
     *
     * @return MessageType
     */
    public function sendAnimation(SendAnimationMethod $method): MessageType
    {
        return $this->send($method);
    }

    /**
     * @param SendVoiceMethod $method
     *
     * @throws ResponseException
     *
     * @return MessageType
     */
    public function sendVoice(SendVoiceMethod $method): MessageType
    {
        return $this->send($method);
    }

    /**
     * @param SendVideoNoteMethod $method
     *
     * @throws ResponseException
     *
     * @return MessageType
     */
    public function sendVideoNote(SendVideoNoteMethod $method): MessageType
    {
        return $this->send($method);
    }

    /**
     * @param SendGameMethod $method
     *
     * @throws ResponseException
     *
     * @return MessageType
     */
    public function sendGame(SendGameMethod $method): MessageType
    {
        return $this->send($method);
    }

    /**
     * @param SendInvoiceMethod $method
     *
     * @throws ResponseException
     *
     * @return MessageType
     */
    public function sendInvoice(SendInvoiceMethod $method): MessageType
    {
        return $this->send($method);
    }

    /**
     * @param SendLocationMethod $method
     *
     * @throws ResponseException
     *
     * @return MessageType
     */
    public function sendLocation(SendLocationMethod $method): MessageType
    {
        return $this->send($method);
    }

    /**
     * @param SendVenueMethod $method
     *
     * @throws ResponseException
     *
     * @return MessageType
     */
    public function sendVenue(SendVenueMethod $method): MessageType
    {
        return $this->send($method);
    }

    /**
     * @param SendContactMethod $method
     *
     * @throws ResponseException
     *
     * @return MessageType
     */
    public function sendContact(SendContactMethod $method): MessageType
    {
        return $this->send($method);
    }

    /**
     * @param SendStickerMethod $method
     *
     * @throws ResponseException
     *
     * @return MessageType
     */
    public function sendSticker(SendStickerMethod $method): MessageType
    {
        return $this->send($method);
    }

    /**
     * @param SendMessageMethod $method
     *
     * @throws ResponseException
     *
     * @return MessageType
     */
    public function sendMessage(SendMessageMethod $method): MessageType
    {
        return $this->send($method);
    }
}
