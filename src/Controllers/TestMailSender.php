<?php

namespace App\Boutique\Controllers;

use App\Boutique\Manager\MailManager;
use App\Boutique\Utils\Render;

/**
 * TestMailSender
 *
 * Cette class permet de faire un le rendu d'un test d'envoie d'email.
 *
 *
 */
class TestMailSender extends Render
{
    /**
     * Méthode SendMail
     *
     * @param array [...$arguments Les arguments transmis à la méthode.]
     * @return string [Le contenu généré en rendant le template 'test-render' avec les arguments fournis.]
     */
    public function SendMail(...$arguments)
    {
        $message =
            'Merci de votre inscription sur TheCoffee vous pouvez dès à présent faire des commandes de café ou de thé';

        $mail = MailManager::sendMailPHP(
            [

                'jean-philippe.douzou@laplateforme.io',

            ],
            'Bienvenue sur TheCoffe.test',
            $message,
        );
        // Affichage du template HTML de la vue test-mail-sender
        $content = $this->render('test-mail-sender', $arguments);
        return $content;
    }
}
