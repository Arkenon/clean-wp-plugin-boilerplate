<?php
/**
 * Mailer class
 * This class is responsible for sending emails.
 * @package PluginName
 * @subpackage PluginName\Common\Tools
 * @since 1.0.0
 */

namespace PluginName\Common\Tools;

defined( 'ABSPATH' ) || exit;

class Mailer {
	private string $to = '';
	private string $subject = '';
	private string $message = '';
	private string $headers = '';
	private array $attachments = [];

	/**
	 * Set the recipient of the email.
	 *
	 * @param string $to
	 *
	 * @return $this
	 * @since 1.0.0
	 */
	public function setTo( string $to ): self {
		$this->to = $to;

		return $this;
	}

	/**
	 * Set the subject of the email.
	 *
	 * @param string $subject
	 *
	 * @return $this
	 * @since 1.0.0
	 */
	public function setSubject( string $subject ): self {
		$this->subject = $subject;

		return $this;
	}

	/**
	 * Set the message of the email.
	 *
	 * @param string $message
	 *
	 * @return $this
	 * @since 1.0.0
	 */
	public function setMessage( string $message ): self {
		$this->message = $message;

		return $this;
	}

	/**
	 * Set the headers of the email.
	 *
	 * @param string $headers
	 *
	 * @return $this
	 * @since 1.0.0
	 */
	public function setHeaders( string $headers ): self {
		$this->headers = $headers;

		return $this;
	}

	/**
	 * Add a header to the email.
	 *
	 * @param string $header
	 *
	 * @return $this
	 * @since 1.0.0
	 */
	public function addHeader( string $header ): self {
		$this->headers .= $header . "\r\n";

		return $this;
	}

	/**
	 * Set the attachments of the email.
	 *
	 * @param array $attachments
	 *
	 * @return $this
	 * @since 1.0.0
	 */
	public function setAttachments( array $attachments ): self {
		$this->attachments = $attachments;

		return $this;
	}

	/**
	 * Add an attachment to the email.
	 *
	 * @param string $attachment
	 *
	 * @return $this
	 * @since 1.0.0
	 */
	public function addAttachment( string $attachment ): self {
		$this->attachments[] = $attachment;

		return $this;
	}

	/**
	 * Set the email content type to plain text.
	 *
	 * @param string $html
	 *
	 * @return $this
	 * @since 1.0.0
	 */
	public function setHtmlContent( string $html ): self {
		$this->addHeader( 'Content-Type: text/html; charset=UTF-8' );
		$this->setMessage( $html );

		return $this;
	}

	/**
	 * Set the email content type to plain text.
	 *
	 * @param string $email
	 * @param string $name
	 *
	 * @return $this
	 * @since 1.0.0
	 */
	public function setFrom( string $email, string $name = '' ): self {
		$from = $name ? "$name <$email>" : $email;
		$this->addHeader( "From: $from" );

		return $this;
	}

	/**
	 * Set the email content type to plain text.
	 *
	 * @param string $cc
	 *
	 * @return $this
	 * @since 1.0.0
	 */
	public function setCc( string $cc ): self {
		$this->addHeader( "Cc: $cc" );

		return $this;
	}

	/**
	 * Set the email content type to plain text.
	 *
	 * @param string $bcc
	 *
	 * @return $this
	 * @since 1.0.0
	 */
	public function setBcc( string $bcc ): self {
		$this->addHeader( "Bcc: $bcc" );

		return $this;
	}

	/**
	 * Send the email.
	 *
	 * @return bool
	 * @since 1.0.0
	 */
	public function send(): bool {
		return wp_mail( $this->to, $this->subject, $this->message, $this->headers, $this->attachments );
	}
}
