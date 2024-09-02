<?php

namespace PluginName\Common\Services;

defined( 'ABSPATH' ) || exit;

class Mailer {
	private string $to = '';
	private string $subject = '';
	private string $message = '';
	private string $headers = '';
	private array $attachments = [];

	public function setTo( string $to ): self {
		$this->to = $to;

		return $this;
	}

	public function setSubject( string $subject ): self {
		$this->subject = $subject;

		return $this;
	}

	public function setMessage( string $message ): self {
		$this->message = $message;

		return $this;
	}

	public function setHeaders( string $headers ): self {
		$this->headers = $headers;

		return $this;
	}

	public function addHeader( string $header ): self {
		$this->headers .= $header . "\r\n";

		return $this;
	}

	public function setAttachments( array $attachments ): self {
		$this->attachments = $attachments;

		return $this;
	}

	public function addAttachment( string $attachment ): self {
		$this->attachments[] = $attachment;

		return $this;
	}

	public function setHtmlContent( string $html ): self {
		$this->addHeader( 'Content-Type: text/html; charset=UTF-8' );
		$this->setMessage( $html );

		return $this;
	}

	public function setFrom( string $email, string $name = '' ): self {
		$from = $name ? "$name <$email>" : $email;
		$this->addHeader( "From: $from" );

		return $this;
	}

	public function setCc( string $cc ): self {
		$this->addHeader( "Cc: $cc" );

		return $this;
	}

	public function setBcc( string $bcc ): self {
		$this->addHeader( "Bcc: $bcc" );

		return $this;
	}

	public function send(): bool {
		return wp_mail( $this->to, $this->subject, $this->message, $this->headers, $this->attachments );
	}
}
