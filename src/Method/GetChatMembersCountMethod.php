<?php

declare(strict_types=1);

namespace TgBotApi\BotApiBase\Method;

use TgBotApi\BotApiBase\Method\Traits\ChatIdVariableTrait;

/**
 * Class GetChatMembersCountMethod.
 *
 * @see https://core.telegram.org/bots/api#getchatmemberscount
 */
class GetChatMembersCountMethod
{
    use ChatIdVariableTrait;

    /**
     * @param int|string $chatId
     *
     * @return GetChatMembersCountMethod
     */
    public static function create($chatId): GetChatMembersCountMethod
    {
        $instance = new static();
        $instance->chatId = $chatId;

        return $instance;
    }
}
