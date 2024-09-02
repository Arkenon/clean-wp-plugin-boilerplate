<?php

namespace PluginName\Infrastructure\Services;

use PluginName\Common\Services\Mailer;

defined('ABSPATH') || exit;

class MailService
{
	private Mailer $mailer;

	public function __construct(Mailer $mailer)
	{
		$this->mailer = $mailer;
	}

	public function sendMail(string $to, string $username): bool
	{
		return $this->mailer
			->setTo($to)
			->setSubject(esc_html__('Welcome!', 'plugin-name'))
			->setFrom(sanitize_email('noreply@example.com'), esc_html__('Example Team', 'plugin-name'))
			->setHtmlContent(sprintf(esc_html__("Hello, %s!", 'plugin-name'), $username))
			->send();
	}

}
