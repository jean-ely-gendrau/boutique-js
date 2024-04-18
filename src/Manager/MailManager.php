<?php

namespace App\Boutique\Manager;

class MailManager
{
    /**
     * Method extractUserNameMail
     *
     * Cette méthod
     * @param array $emails [explicite description]
     *
     * @return array
     */
    private static function extractUserNameMail(array $emails): array
    {
        $bufferOUT = [];

        if (is_array($emails)):
            foreach ($emails as $mail):
                if (preg_match('/^(?<=@)$/', $mail, $matches)):
                    $tempArray = [$matches[1] . " <$mail>"];
                    array_push($bufferOUT, $tempArray);
                endif;
            endforeach;
        endif;

        return $bufferOUT;
    }

    private static function importTemplateMail(
        $templateMail,
        $subject,
        $messageMail,
    ) {
        // Remplacement des variable $titleMessageMail et $messageMail
        return str_replace(
            ['$titleMessageMail', '$messageMail'],
            [$subject, $messageMail],
            file_get_contents(
                __DIR__ .
                DIRECTORY_SEPARATOR .
                "../../templateMail/{$templateMail}.php",
            ),
        );
    }
    /**
     * Method sendMailPHP
     *
     *
     * @param array $emails [Tableau des emails des déstinataires du message]
     * @param string $subjectMail [Sujet du message]
     * @param string $messageMail [Message à ajouté au template mail]
     * @param array $templateMail = 'default' [Template pour l'envoie du mail dans le dossier templateMail]
     *
     * @return void
     */
    public static function sendMailPHP(
        array $emails,
        string $subjectMail,
        string $messageMail,
        string $templateMail = 'default',
    ): void {
        /* CODE EXTRAIT DE PHP https://www.php.net/manual/fr/function.mail.php */
        $mailHeader = implode(',', self::extractUserNameMail($emails));

        // Plusieurs destinataires possible séparer par des virgules
        $to = implode(',', $emails); //

        // Sujet
        $subject = "{$subjectMail}";

        // message HTML
        $message = self::importTemplateMail(
            $templateMail,
            $subject,
            $messageMail,
        );

        // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';

        // En-têtes additionnels
        $headers[] = "To: {$mailHeader}";
        $headers[] = 'From: admin@teacoffee.test';
        //   $headers[] = 'Cc: email de la personne en copie invisible à la personne qui reçois le mail';
        //   $headers[] = 'Bcc: exactement le même comportement que le précédant';

        // Envoi
        //DEBUG DP dp($headers, $message);
        mail($to, $subject, $message, implode("\r\n", $headers));
    }
}
