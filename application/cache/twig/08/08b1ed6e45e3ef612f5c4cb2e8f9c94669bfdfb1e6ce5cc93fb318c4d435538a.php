<?php

/* webview/modals/message-conversion-modal.twig */
class __TwigTemplate_d71f7bf9520f222f68cc828af1c25038507141501c0986e06123625e80977135 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div id=\"message_convertionModal\" class=\"modal custom_modal\">
    <div class=\"modal-dialog cccc_massage_box\">
        <div style=\"padding: 30px;padding-bottom: 60px;\" class=\"modal-content\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" onclick=\"hidemessagepopup();\">&times;</button>
            <h4 class=\"modal-title\">";
        // line 5
        echo twig_escape_filter($this->env, app_lang("text_job_modal_message"), "html", null, true);
        echo "</h4>
            <div class=\"modal-header\">
                <div class=\"chat-screen\">
                    <div class=\"chat-details-topbar\">
                        <h3 class=\"user_name\"></h3>
                        <h5 class=\"job_title\"></h5>
                    </div>
                </div>
            </div>
        <div class=\"modal-body\">
            <div class=\"message_lists chat-details form-group\" ></div>
            <form style=\"position:relative;\" name=\"message\" action=\"\" method=\"post\" id=\"conversion_message\">
                <textarea name=\"usermsg\"  id=\"usermsg\"></textarea>
                <div style=\"position: absolute;right: 23%;font-size: 26px;top: 35%;color:#a2a2a2;transform: rotate(90deg);\" class=\"attach_icon\">
                    <i style=\"cursor: pointer;\" class=\"fa fa-paperclip\" aria-hidden=\"true\"></i>
                </div>
                <input name=\"job_id\" type=\"hidden\" id=\"job_id\"  value=\"\" />
                <input name=\"bid_id\" type=\"hidden\" id=\"bid_id\"  value=\"\"  />
                <input name=\"sender_id\" type=\"hidden\" id=\"sender_id\"  value=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->getAttribute(app_user_data(), "id", array(), "array"), "html", null, true);
        echo "\"  />
                <input name=\"receiver_id\" type=\"hidden\" id=\"receiver_id\"  value=\"\"  />
                <input name=\"submitmsg\" type=\"submit\"  id=\"submitmsg\" value=\"";
        // line 25
        echo twig_escape_filter($this->env, app_lang("text_job_modal_btn_send"), "html", null, true);
        echo "\" />
             </form>
        </div>
    </div>
 </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "webview/modals/message-conversion-modal.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 25,  46 => 23,  25 => 5,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div id=\"message_convertionModal\" class=\"modal custom_modal\">
    <div class=\"modal-dialog cccc_massage_box\">
        <div style=\"padding: 30px;padding-bottom: 60px;\" class=\"modal-content\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" onclick=\"hidemessagepopup();\">&times;</button>
            <h4 class=\"modal-title\">{{ app_lang('text_job_modal_message') }}</h4>
            <div class=\"modal-header\">
                <div class=\"chat-screen\">
                    <div class=\"chat-details-topbar\">
                        <h3 class=\"user_name\"></h3>
                        <h5 class=\"job_title\"></h5>
                    </div>
                </div>
            </div>
        <div class=\"modal-body\">
            <div class=\"message_lists chat-details form-group\" ></div>
            <form style=\"position:relative;\" name=\"message\" action=\"\" method=\"post\" id=\"conversion_message\">
                <textarea name=\"usermsg\"  id=\"usermsg\"></textarea>
                <div style=\"position: absolute;right: 23%;font-size: 26px;top: 35%;color:#a2a2a2;transform: rotate(90deg);\" class=\"attach_icon\">
                    <i style=\"cursor: pointer;\" class=\"fa fa-paperclip\" aria-hidden=\"true\"></i>
                </div>
                <input name=\"job_id\" type=\"hidden\" id=\"job_id\"  value=\"\" />
                <input name=\"bid_id\" type=\"hidden\" id=\"bid_id\"  value=\"\"  />
                <input name=\"sender_id\" type=\"hidden\" id=\"sender_id\"  value=\"{{ app_user_data()['id'] }}\"  />
                <input name=\"receiver_id\" type=\"hidden\" id=\"receiver_id\"  value=\"\"  />
                <input name=\"submitmsg\" type=\"submit\"  id=\"submitmsg\" value=\"{{ app_lang('text_job_modal_btn_send') }}\" />
             </form>
        </div>
    </div>
 </div>
</div>
", "webview/modals/message-conversion-modal.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\modals\\message-conversion-modal.twig");
    }
}
