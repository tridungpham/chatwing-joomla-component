<?php

/**
 * @author dphamtri
 * @package
 */
class ChatwingViewChatbox extends JViewLegacy
{
    public function display($tpl = null)
    {
        $app = JFactory::getApplication();
        $params = $app->getParams();

        if(!$params->get('alias')) {
            return;
        }

        // set the template variable
        $this->width = $params->get('width');
        $this->height = $params->get('height');

        $container = JFactory::getApplication()->get('cw_container');
        $this->box = $container['cb'];
        $this->box->setAlias($params->get('alias'));

        if ($params->get('custom_login_enable') && $params->get('custom_login_secret')) {
            $user = JFactory::getUser();
            if ($user->id) {
                $jSession = JFactory::getSession();            
                if($jSession->has('custom_session', 'chatwing')) {
                    $this->box->setParam('custom_session', $jSession->get('cw_custom_session',null, 'chatwing'));
                } else {
                    $this->box->setSecret($params->get('custom_login_secret'));
                    $preparedData = array(
                        'id' => $user->id,
                        'name' => $user->name,
                        'expire' => round(microtime(true) * 1000) + 60 * 60 * 1000,
                        'avatar' => ChatwingCommonHelper::getGravatarUrl($user->email)
                    );
                    $data['custom_session'] = $preparedData;
                    $this->box->setParam($data);
                    $jSession->set('custom_session', $this->box->getEncryptedSession(), 'chatwing');
                }
            }
        }
        return parent::display($tpl);
    }

}